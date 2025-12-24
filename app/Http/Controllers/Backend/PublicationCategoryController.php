<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\PublicationCategory;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;
use App\Http\Requests\PublicationCategoryRequest;

class PublicationCategoryController extends BaseController
{
    public function index()
    {
        return view('backend.publication-category.index');
    }

    public function publicationCategoryData()
    {
        $datas = PublicationCategory::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = PublicationCategory::orderBy('display_order', 'desc')->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        return view('backend.publication-category.create', compact('displayOrder'));
    }

    public function store(PublicationCategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            PublicationCategory::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
            ]);

            DB::commit();

            Session::flash('success', 'Publication Category created successfully.');
            return redirect()->route('publication-category.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(PublicationCategory $publicationCategory)
    {
        return view('backend.publication-category.edit', compact('publicationCategory'));
    }

    public function update(PublicationCategoryRequest $request, PublicationCategory $publicationCategory)
    {
        DB::beginTransaction();

        try {
            $details = [
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
            ];

            $publicationCategory->update($details);

            DB::commit();

            Session::flash('success', 'Publication Category updated successfully.');

            return redirect()->route('publication-category.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(PublicationCategory $publicationCategory)
    {
        DB::beginTransaction();
        try {
            $publicationCategory->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
