<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Download;
use App\Models\DownloadCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\DownloadRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;

class DownloadController extends BaseController
{
    public function index()
    {
        return view('backend.download.index');
    }

    public function downloadData()
    {
        $datas = Download::with('downloadCategory')->orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Download::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $downloadCategories = DownloadCategory::published()->get();

        return view('backend.download.create', compact('displayOrder', 'downloadCategories'));
    }

    public function store(DownloadRequest $request)
    {
        DB::beginTransaction();
        try {
            $download = Download::create([
                'download_category_id' => $request->download_category_id,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            $filePath = '';
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();

                $relativePath = 'uploads/download/' . $download->id . '/file/';
                $destinationPath = public_path($relativePath);

                // Create the directory if it doesn't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Move the file
                $file->move($destinationPath, $filename);

                $filePath = $relativePath . $filename; // store relative path or use asset() for full URL
            }

            $download->update([
                'file' => $filePath,
            ]);

            DB::commit();

            Session::flash('success', 'Download created successfully.');

            return redirect()->route('download.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Download $download)
    {
        $downloadCategories = DownloadCategory::published()->get();

        return view('backend.download.edit', compact('download', 'downloadCategories'));
    }

    public function update(DownloadRequest $request, Download $download)
    {
        DB::beginTransaction();

        try {
            $download->update([
                'download_category_id' => $request->download_category_id,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            $filePath = $download->file;
            if ($request->hasFile('file')) {
                $existingFilePath = public_path('uploads/download/' . $download->id . '/file');
                if (File::exists($existingFilePath)) {
                    File::deleteDirectory($existingFilePath);
                }

                $file = $request->file('file');

                $filename = $file->getClientOriginalName();

                $relativePath = 'uploads/download/' . $download->id . '/files/';
                $destinationPath = public_path($relativePath);

                // Create the directory if it doesn't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Move the file first
                $file->move($destinationPath, $filename);

                // Full path for the file
                $path = $destinationPath . '/' . $filename;

                // Save the file again (overwrite/copy) using File::put
                File::put($path, file_get_contents($path));

                // Store relative path in DB
                $filePath = $relativePath . $filename;

                $download->update([
                    'file' => $filePath,
                ]);
            }

            DB::commit();

            Session::flash('success', 'Download updated successfully.');

            return redirect()->route('download.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function deleteDocument(Download $download, $imageIndex)
    {
        DB::beginTransaction();
        try {
            $file = json_decode($download->file, true);
            // Remove the selected image based on its index
            if (isset($file[$imageIndex])) {
                $imagePath = $file[$imageIndex];
                unset($file[$imageIndex]);

                // Delete the image from storage
                File::delete($imagePath);

                // Update the gallery with the remaining images
                $download->update([
                    'file' => json_encode($file),
                ]);

                DB::commit();
                return response()->json(['status' => true, 'message' => 'Files deleted successfully.']);
            }

            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Files not found.']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Sorry, there was an error.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Download $download)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/download/' . $download->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $download->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
