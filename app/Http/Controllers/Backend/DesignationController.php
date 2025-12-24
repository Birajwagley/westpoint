<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Designation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\DesignationRequest;
use App\Http\Controllers\Backend\BaseController;

class DesignationController extends BaseController
{
    public function index()
    {
        return view('backend.designation.index');
    }

    public function designationData()
    {
        $datas = Designation::displayOrder()->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Designation::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        return view('backend.designation.create', compact('displayOrder'));
    }

    public function store(DesignationRequest $request)
    {
        DB::beginTransaction();
        try {
            Designation::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Designation created successfully.');

            return redirect()->route('designation.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
    public function edit(Designation $designation)
    {
        return view('backend.designation.edit', compact('designation'));
    }

    public function update(DesignationRequest $request, Designation $designation)
    {
        DB::beginTransaction();

        try {
            $details = [
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ];

            $designation->update($details);

            DB::commit();

            Session::flash('success', 'Designation updated successfully.');

            return redirect()->route('designation.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(Designation $designation)
    {
        DB::beginTransaction();
        try {
            $designation->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
