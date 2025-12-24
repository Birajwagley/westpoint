<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\subjectRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;

class SubjectController extends BaseController
{
    public function index()
    {
        return view('backend.subject.index');
    }

    public function subjectData()
    {
        $datas = Subject::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Subject::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        return view('backend.subject.create', compact('displayOrder'));
    }

    public function store(SubjectRequest $request)
    {
        DB::beginTransaction();
        try {
            Subject::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Subject created successfully.');

            return redirect()->route('subject.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Subject $subject)
    {
        return view('backend.subject.edit', compact('subject'));
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        DB::beginTransaction();
        try {
            $subject->update([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Subject updated successfully.');

            return redirect()->route('subject.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(Subject $subject)
    {
        DB::beginTransaction();
        try {
            $subject->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
