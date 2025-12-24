<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Group;
use App\Models\Classes;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Admission;
use App\Enum\GenderTypeEnum;
use App\Models\AcademicLevel;
use App\Enum\AdmissionTypeEnum;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\FacultyGroupSubject;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AdmissionRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;

class AdmissionController extends BaseController
{
    public function index()
    {
        return view('backend.admission.index');
    }

    public function admissionData()
    {
        $datas = Admission::with(['academicLevel', 'parents', 'school', 'college.subjects'])
            ->orderByDesc('id')
            ->get();

        return response()->json(['datas' => $datas]);
    }

    public function create()
    {
        $classes = Classes::published()->get();
        $faculties = Faculty::published()->get();
        $groups = Group::published()->get();
        $academicLevels = AcademicLevel::published()->get();
        $types = GenderTypeEnum::cases();
        $admissionType = AdmissionTypeEnum::cases();
        $subjects = collect();
        $admission = null;
        $parents = [['relation' => 'Father', 'name' => '', 'occupation' => '', 'contact_no' => ''], ['relation' => 'Mother', 'name' => '', 'occupation' => '', 'contact_no' => '']];
        return view('backend.admission.create', compact('classes', 'faculties', 'groups', 'academicLevels', 'types', 'admissionType', 'subjects', 'admission', 'parents'));
    }

    public function store(AdmissionRequest $request)
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

            if ($request->is_school == 1) {
                $admission->school()->create([
                    'admission_id' => $admission->id,
                    'admission_type' => $request->admission_type,
                    'class_id' => $request->class_id,
                    'last_class_id' => $request->last_class_id ?? null,
                ]);
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

            Session::flash('success', 'Admission created successfully.');
            return redirect()->route('admission.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Admission $admission)
    {
        $admission->load('parents', 'school', 'subjects.facultyGroupSubject', 'academicLevel');

        $subjectIds = $admission->subjects->pluck('id');
        $subjectMappings = FacultyGroupSubject::whereIn('subject_id', $subjectIds)->pluck('subject_id', 'group_id');

        $subjects = collect();
        $selectedSubjectIds = [];

        if (!$admission->is_school && $admission->college && $admission->college->faculty_id) {
            $subjects = Subject::whereHas('faculties', function ($q) use ($admission) {
                $q->where('faculties.id', $admission->college->faculty_id);
            })->get();

            $selectedSubjectIds = $admission->college->subjects ? $admission->college->subjects->pluck('id')->toArray() : [];
        }

        $parents = $admission->parents->toArray();

        if (count($parents) < 2) {
            $parents = [['relation' => 'Father', 'name' => '', 'occupation' => '', 'contact_no' => ''], ['relation' => 'Mother', 'name' => '', 'occupation' => '', 'contact_no' => '']];
        }

        return view('backend.admission.edit', [
            'admission' => $admission,
            'classes' => Classes::published()->get(),
            'faculties' => Faculty::published()->get(),
            'groups' => Group::published()->get(),
            'academicLevels' => AcademicLevel::published()->get(),
            'types' => GenderTypeEnum::cases(),
            'admissionType' => AdmissionTypeEnum::cases(),
            'subjects' => $subjects,
            'selectedSubjectIds' => $selectedSubjectIds,
            'parents' => $parents,
            'subjectMappings' => $subjectMappings,
        ]);
    }

    public function update(AdmissionRequest $request, Admission $admission)
    {
        DB::beginTransaction();
        try {
            // Update main admission data
            $admission->update($request->only(['first_name', 'middle_name', 'last_name', 'email', 'dob_bs', 'dob_ad', 'age', 'gender', 'other_gender', 'permanent_address', 'current_address', 'nationality', 'contact_no', 'living_with_guardian', 'academic_year', 'previous_school', 'previous_school_address', 'pick_drop_facility_needed', 'pick_drop_location', 'academic_level_id', 'is_school', 'approval']));

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $admission->update([
                    'photo' => $request->file('photo')->store('admissions', 'public'),
                ]);
            }

            // Update parents
            if ($request->has('parents')) {
                // Delete existing parents first
                $admission->parents()->delete();

                foreach ($request->parents as $parentData) {
                    // Skip if no relation entered
                    if (!isset($parentData['relation']) || trim($parentData['relation']) == '') {
                        continue;
                    }

                    // Save new parents
                    $admission->parents()->create([
                        'relation' => $parentData['relation'],
                        'name' => $parentData['name'] ?? null,
                        'occupation' => $parentData['occupation'] ?? null,
                        'contact_no' => $parentData['contact_no'] ?? null,
                    ]);
                }
            }

            // School info
            if ($request->is_school == 1) {
                // Delete college if exists
                $admission->college()->delete();

                // Update or create school
                $admission->school()->updateOrCreate(
                    ['admission_id' => $admission->id],
                    [
                        'admission_type' => $request->admission_type,
                        'class_id' => $request->class_id,
                        'last_class_id' => $request->last_class_id ?? null,
                    ],
                );
            }

            // College info
            if ($request->is_school == 0) {
                // Delete school if exists
                $admission->school()->delete();

                // Update or create college
                $admission->college()->updateOrCreate(
                    ['admission_id' => $admission->id],
                    [
                        'faculty_id' => $request->faculty_id,
                        'gpa' => $request->gpa,
                        'board' => $request->board,
                    ],
                );

                // Sync subjects
                $admission->subjects()->sync($request->subjects ?? []);
            }

            DB::commit();

            Session::flash('success', 'Admission updated successfully.');
            return redirect()->route('admission.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function show(Admission $admission)
    {
        $admission->load(['parents', 'school', 'college', 'subjects.groups', 'academicLevel']);
        $groups = Group::all();

        return view('backend.admission.show', compact('admission', 'groups'));
    }

    public function download($id)
    {
        $admission = Admission::with(['college', 'school', 'parents'])->findOrFail($id);

        $pdf = Pdf::loadView('admission.pdf', compact('admission'))->setPaper('a4', 'portrait');

        return $pdf->download('admission-details.pdf');
    }

    public function destroy(Admission $admission)
    {
        DB::beginTransaction();
        try {
            File::deleteDirectory(public_path("uploads/admission/{$admission->id}"));

            $admission->parents()->delete();
            $admission->school()->delete();

            if ($admission->college) {
                $admission->college->delete();
                $admission->college()->delete();
            }

            $admission->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }

    public function getSubjectsByFaculty(Faculty $faculty)
    {
        $faculty->load('groupSubjectFaculties.subject');

        return $faculty->groupSubjectFaculties;
    }
}
