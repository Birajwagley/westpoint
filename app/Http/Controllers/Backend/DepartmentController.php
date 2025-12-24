<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\DepartmentRequest;
use App\Http\Controllers\Backend\BaseController;

class DepartmentController extends BaseController
{
    public function index()
    {
        return view('backend.department.index');
    }

    public function departmentData()
    {
        $datas = Department::displayOrder()->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Department::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        return view('backend.department.create', compact('displayOrder'));
    }

    public function store(DepartmentRequest $request)
    {
        DB::beginTransaction();
        try {
            Department::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Department created successfully.');

            return redirect()->route('department.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
    public function edit(Department $department)
    {
        return view('backend.department.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        DB::beginTransaction();

        try {
            $details = [
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ];

            $department->update($details);

            DB::commit();

            Session::flash('success', 'Department updated successfully.');

            return redirect()->route('department.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(Department $department)
    {
        DB::beginTransaction();
        try {
            $department->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
