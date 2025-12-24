<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Group;
use App\Models\Classes;
use App\Models\Faculty;
use App\Models\Admission;
use App\Enum\GenderTypeEnum;
use App\Models\AcademicLevel;
use App\Enum\AdmissionTypeEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Frontend\AdmissionFormRequest;
use App\Mail\CollegeMail;
use App\Mail\SchoolMail;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;

class OnlineAdmissionController extends Controller
{
    // public function admissionProcedure()
    // {
    //     return view('frontend.admission-procedure');
    // }

    public function schoolLevel()
    {
        $classes = Classes::published()->get();
        $faculties = Faculty::published()->get();
        $groups = Group::published()->get();
        $academicLevels = AcademicLevel::published()->get();
        $types = GenderTypeEnum::cases();
        $admissionType = AdmissionTypeEnum::cases();
        $admission = null;
        $typeOfAdmission = true;

        $parents = [['relation' => 'Father', 'name' => '', 'occupation' => '', 'contact_no' => ''], ['relation' => 'Mother', 'name' => '', 'occupation' => '', 'contact_no' => '']];

        return view('frontend.admission.admission-form', compact('classes', 'faculties', 'groups', 'academicLevels', 'types', 'admissionType', 'parents', 'admission', 'typeOfAdmission'));
    }

    public function storeSchoolLevel(AdmissionFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $admission = Admission::create($request->only(['first_name', 'middle_name', 'last_name', 'email', 'dob_bs', 'dob_ad', 'age', 'gender', 'other_gender', 'permanent_address', 'current_address', 'nationality', 'contact_no', 'living_with_guardian', 'academic_year', 'previous_school', 'previous_school_address', 'pick_drop_facility_needed', 'pick_drop_location', 'academic_level_id', 'is_school', 'approval']));

            if ($request->hasFile('photo')) {
                $admission->update([
                    'photo' => $request->file('photo')->store('admissions', 'public'),
                ]);
            }

            // Save new parents data
            if ($request->has('parents')) {
                foreach ($request->parents as $index => $parentData) {
                    // Skip if no relation entered
                    if (!isset($parentData['relation']) || trim($parentData['relation']) == '') {
                        continue;
                    }

                    // Save record exactly as user entered
                    $admission->parents()->create([
                        'relation' => $parentData['relation'], // Father, Mother, Uncle, Sponsor, etc.
                        'name' => $parentData['name'] ?? null,
                        'occupation' => $parentData['occupation'] ?? null,
                        'contact_no' => $parentData['contact_no'] ?? null,
                    ]);
                }
            }

            // school or college
            if ($request->is_school == 1) {
                $admission->school()->create([
                    'admission_id' => $admission->id,
                    'admission_type' => $request->admission_type,
                    'class_id' => $request->class_id,
                    'last_class_id' => $request->last_class_id ?? null,
                ]);
            }
            DB::commit();

            $setting = Setting::first();

            if (!empty($setting->admission_notify_email)) {
                Mail::to($setting->admission_notify_email)->send(new SchoolMail($admission));
            }

            Session::flash('success', 'Admission created successfully.');
            return redirect()->route('online-admission.school-level');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function collegeLevel()
    {
        $classes = Classes::published()->get();
        $faculties = Faculty::published()->get();
        $groups = Group::published()->get();
        $academicLevels = AcademicLevel::whereId(5)->published()->get();
        $types = GenderTypeEnum::cases();
        $subjects = collect();
        $admission = null;
        $typeOfAdmission = false;
        $admissionType = AdmissionTypeEnum::cases();

        $parents = [['relation' => 'Father', 'name' => '', 'occupation' => '', 'contact_no' => ''], ['relation' => 'Mother', 'name' => '', 'occupation' => '', 'contact_no' => '']];

        return view('frontend.admission.admission-form', compact('classes', 'faculties', 'groups', 'academicLevels', 'types', 'admissionType', 'parents', 'admission', 'typeOfAdmission'));
    }

    public function storeCollegeLevel(AdmissionFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $admission = Admission::create($request->only(['first_name', 'middle_name', 'last_name', 'email', 'dob_bs', 'dob_ad', 'age', 'gender', 'other_gender', 'permanent_address', 'current_address', 'nationality', 'contact_no', 'living_with_guardian', 'academic_year', 'previous_school', 'previous_school_address', 'pick_drop_facility_needed', 'pick_drop_location', 'academic_level_id', 'is_school', 'approval']));

            if ($request->hasFile('photo')) {
                $admission->update([
                    'photo' => $request->file('photo')->store('admissions', 'public'),
                ]);
            }

            if ($request->has('parents')) {
                foreach ($request->parents as $index => $parentData) {
                    if (!isset($parentData['relation']) || trim($parentData['relation']) == '') {
                        continue;
                    }

                    $admission->parents()->create([
                        'relation' => $parentData['relation'],
                        'name' => $parentData['name'] ?? null,
                        'occupation' => $parentData['occupation'] ?? null,
                        'contact_no' => $parentData['contact_no'] ?? null,
                    ]);
                }
            }

            if ($request->is_school == 0) {
                $admission->college()->create([
                    'admission_id' => $admission->id,
                    'faculty_id' => $request->faculty_id,
                    'gpa' => $request->gpa,
                    'board' => $request->board,
                ]);

                $admission->subjects()->attach($request->subjects ?? []);
            }

            DB::commit();

            $setting = Setting::first();

            if (!empty($setting->admission_notify_email)) {
                Mail::to($setting->admission_notify_email)->send(new CollegeMail($admission));
            }

            Session::flash('success', 'Admission created successfully.');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function getSubjectsByFaculty(Faculty $faculty)
    {
        $faculty->load('groupSubjectFaculties.subject');

        return $faculty->groupSubjectFaculties;
    }
}
