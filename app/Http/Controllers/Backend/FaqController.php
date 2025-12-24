<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\FaqRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;

class FaqController extends BaseController
{
    public function index()
    {
        return view('backend.faq.index');
    }

    public function faqData()
    {
        $datas = Faq::with('faqCategory')->orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Faq::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $faqCategories = FaqCategory::published()->get();

        return view('backend.faq.create', compact('displayOrder', 'faqCategories'));
    }

    public function store(FaqRequest $request)
    {
        DB::beginTransaction();
        try {
            Faq::create([
                'faq_category_id' => $request->faq_category_id,
                'question_en' => $request->question_en,
                'question_np' => $request->question_np,
                'answer_en' => $request->answer_en,
                'answer_np' => $request->answer_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Faq created successfully.');

            return redirect()->route('faq.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Faq $faq)
    {
        $faqCategories = FaqCategory::published()->get();

        return view('backend.faq.edit', compact('faq', 'faqCategories'));
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        DB::beginTransaction();

        try {
            $faq->update([
                'faq_category_id' => $request->faq_category_id,
                'question_en' => $request->question_en,
                'question_np' => $request->question_np,
                'answer_en' => $request->answer_en,
                'answer_np' => $request->answer_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Faq updated successfully.');

            return redirect()->route('faq.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(faq $faq)
    {
        DB::beginTransaction();
        try {
            $faq->delete();
            DB::commit();

            return 1;
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }
}
 