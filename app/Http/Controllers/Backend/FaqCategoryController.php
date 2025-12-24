<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\FaqCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\FaqCategoryRequest;
use App\Http\Controllers\Backend\BaseController;

class FaqCategoryController extends BaseController
{
    public function index()
    {
        return view('backend.faq-category.index');
    }

    public function faqCategoryData()
    {
        $datas = FaqCategory::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = FaqCategory::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        return view('backend.faq-category.create', compact('displayOrder'));
    }

    public function store(FaqCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            FaqCategory::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Faq Category created successfully.');

            return redirect()->route('faq-category.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('backend.faq-category.edit', compact('faqCategory'));
    }

    public function update(FaqCategoryRequest $request, FaqCategory $faqCategory)
    {
        DB::beginTransaction();

        try {
            $details = [
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ];

            $faqCategory->update($details);

            DB::commit();

            Session::flash('success', 'Faq Category updated successfully.');

            return redirect()->route('faq-category.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(FaqCategory $faqCategory)
    {
        DB::beginTransaction();
        try {
            $faqCategory->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
