<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\DownloadCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\DownloadCategoryRequest;
use App\Http\Controllers\Backend\BaseController;

class DownloadCategoryController extends BaseController
{
    public function index() {
        return view('backend.download-category.index');
    }

    public function downloadCategoryData() {

        $datas = DownloadCategory::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create() {

        $displayOrder = DownloadCategory::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;
        return view('backend.download-category.create',compact('displayOrder'));
    }

    public function store(DownloadCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            DownloadCategory::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Download Category created successfully.');

            return redirect()->route('download-category.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

        public function edit(DownloadCategory $downloadCategory)
    {
        return view('backend.download-category.edit', compact('downloadCategory'));
    }

    public function update(DownloadCategoryRequest $request, DownloadCategory $downloadCategory)
    {
        DB::beginTransaction();

        try {
            $details = [
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ];

            $downloadCategory->update($details);

            DB::commit();

            Session::flash('success', 'Download Category updated successfully.');

            return redirect()->route('download-category.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(DownloadCategory $downloadCategory)
    {
        DB::beginTransaction();
        try {
            $downloadCategory->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }

}
