<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Alumni;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AlumniRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class AlumniController extends BaseController
{
    public function edit()
    {
        $alumni = Alumni::first();

        return view('backend.alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlumniRequest $request)
    {
        DB::beginTransaction();
        try {
            $links = [];
            foreach ($request->link_name as $key => $name) {
                $links[] = [
                    'name' => $name,
                    'link' => $request->link[$key],
                ];
            }

            $alumni = Alumni::first();
            $alumni->update([
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'group_en' => $request->group_en,
                'group_np' => $request->group_np,
                'links' => $links,
            ]);

            $imagePath = json_decode($alumni->images, true) ?? null;

            if ($request->hasFile('images')) {
                $directory = public_path('uploads/alumni/' . $alumni->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                foreach ($request->file('images') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = 'uploads/alumni/' . $alumni->id . '/images/' . $filename;

                    // Save the file
                    File::put($path, file_get_contents($file));

                    // Save resized image using Intervention
                    $manager = new ImageManager(new Driver());
                    $manager->read($file)->save($directory . $filename);

                    $imagePath[] = $path; // append new image
                }
            }

            $alumni->update([
                'images' => $imagePath,
            ]);

            DB::commit();
            Session::flash('success', 'Alumni updated successfully.');

            return redirect()->route('alumni.edit');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function deleteImage(Alumni $alumni, $imageIndex)
    {
        DB::beginTransaction();
        try {
            $images = json_decode($alumni->images, true);
            // Remove the selected image based on its index
            if (isset($images[$imageIndex])) {
                $imagePath = $images[$imageIndex];
                unset($images[$imageIndex]);

                $images = count($images) == 0 ? null : $images;

                // Delete the image from storage
                File::delete($imagePath);

                // Update the gallery with the remaining images
                $alumni->update([
                    'images' => $images == null ? null : json_encode($images),
                ]);

                DB::commit();
                return response()->json(['status' => true, 'message' => 'Image deleted successfully.', 'images' => $images]);
            }

            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Image not found.']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Sorry, there was an error.']);
        }
    }

    public function getLinks()
    {
        $index = request()->index;

        return view('backend.alumni.partials.link', compact('index'));
    }
}
