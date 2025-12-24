<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ClassesRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;

class ClassesController extends BaseController
{
    public function index()
    {
        return view('backend.classes.index');
    }

    public function classesData()
    {
        $datas = Classes::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Classes::orderBy('display_order', 'desc')->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        return view('backend.classes.create', compact('displayOrder'));
    }

    public function store(ClassesRequest $request)
    {
        DB::beginTransaction();
        try {
            Classes::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'icon' => $request->icon,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'is_admission_allowed' => $request->is_admission_allowed,
            ]);

            DB::commit();

            Session::flash('success', 'Classes created successfully.');

            return redirect()->route('classes.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Classes $class)
    {
        return view('backend.classes.edit', compact('class'));
    }

    public function update(ClassesRequest $request, Classes $class)
    {
        DB::beginTransaction();

        try {
            $details = [
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'icon' => $request->icon,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'is_admission_allowed' => $request->is_admission_allowed,
            ];

            $class->update($details);

            DB::commit();

            Session::flash('success', 'Classes updated successfully.');

            return redirect()->route('classes.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $class)
    {
        DB::beginTransaction();
        try {
            $class->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
