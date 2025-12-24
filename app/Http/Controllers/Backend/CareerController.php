<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Career;
use App\Models\Designation;
use App\Enum\TimingTypeEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CareerRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;

class CareerController extends BaseController
{
    public function index()
    {
        return view('backend.career.index');
    }

    public function careerData()
    {
        $datas = Career::with('designation')->orderBy('id', 'DESC')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Career::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $designations = Designation::published()->get();
        $timings = TimingTypeEnum::cases();

        return view('backend.career.create', compact('displayOrder', 'designations', 'timings'));
    }

    public function store(CareerRequest $request)
    {
        DB::beginTransaction();
        try {
            Career::create([
                'slug' => $this->checkUnique($request, null, 'careers'),
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'designation_id' => $request->designation_id,
                'number_of_post' => $request->number_of_post,
                'timing' => $request->timing,
                'valid_date' => $request->valid_date,
                'requirement_en' => $request->requirement_en,
                'requirement_np' => $request->requirement_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Career created successfully.');

            return redirect()->route('career.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Career $career)
    {
        $designations = Designation::published()->get();
        $timings = TimingTypeEnum::cases();

        return view('backend.career.edit', compact('career', 'designations','timings'));
    }

    public function update(CareerRequest $request, Career $career)
    {
        DB::beginTransaction();

        try {
            $details = [
                'slug' => $career->slug == $request->slug ? $career->slug : $this->checkUnique($request, $career->id, 'careers'),
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'designation_id' => $request->designation_id,
                'number_of_post' => $request->number_of_post,
                'timing' => $request->timing,
                'valid_date' => $request->valid_date,
                'requirement_en' => $request->requirement_en,
                'requirement_np' => $request->requirement_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ];

            $career->update($details);

            DB::commit();

            Session::flash('success', 'Career updated successfully.');

            return redirect()->route('career.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(Career $career)
    {
        DB::beginTransaction();
        try {
            $career->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
