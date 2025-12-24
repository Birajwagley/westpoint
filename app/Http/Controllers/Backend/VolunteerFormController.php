<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Enum\GenderTypeEnum;
use Illuminate\Http\Request;
use App\Models\VolunteerForm;
use Illuminate\Support\Facades\DB;
use App\Enum\DailyAvailabilityEnum;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\VolunteerFormRequest;
use App\Http\Controllers\Backend\BaseController;

class VolunteerFormController extends BaseController
{
    public function index()
    {
        return view('backend.volunteer-form.index');
    }

    public function volunteerFormData()
    {
        $datas = VolunteerForm::orderBy('id', 'DESC')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $types = GenderTypeEnum::cases();
        $dailyAvailabilitytypes = DailyAvailabilityEnum::cases();

        return view('backend.volunteer-form.create', compact('types', 'dailyAvailabilitytypes'));
    }


    public function destroy(VolunteerForm $volunteerForm)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/volunteer_form/' . $volunteerForm->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $volunteerForm->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }


    public function markAsScanned($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $volunteerForm = VolunteerForm::whereId($id)->update([
                'is_scanned' => $request->is_scanned == 'true' ? 1 : 0,
            ]);

            DB::commit();

            return $volunteerForm;
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function markAsShortlisted($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $volunteerForm = VolunteerForm::whereId($id)->update([
                'is_shortlisted' => $request->is_shortlisted == 'true' ? 1 : 0,
            ]);

            DB::commit();

            return $volunteerForm;
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }


    public function show($id)
    {
        try {
            $volunteerForm = VolunteerForm::findOrFail($id);
            return view('backend.volunteer-form.view', compact('volunteerForm'));
        } catch (Exception $e) {
            Log::error('Volunteer Form view error: ' . $e->getMessage());
            abort(404, 'Volunteer Form not found');
        }
    }


    public function update(VolunteerFormRequest $request, VolunteerForm $volunteerForm)
    {

        DB::beginTransaction();

        try {
            $volunteerForm->update([
                'remarks' => $request->remarks,
                'is_scanned' => $request->is_scanned,
                'is_shortlisted' => $request->is_shortlisted,
            ]);
            DB::commit();

            Session::flash('success', 'Volunteer Form updated successfully.');

            return redirect()->route('volunteer-form.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}
