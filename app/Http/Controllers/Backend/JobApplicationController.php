<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Career;
use App\Enum\GenderTypeEnum;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobApplicationExport;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\JobApplicationRequest;
use App\Http\Controllers\Backend\BaseController;

class JobApplicationController extends BaseController
{
    public function index()
    {
        $careers = Career::all();

        return view('backend.jobApplication.index', compact('careers'));
    }

    public function jobApplicationData()
    {
        $datas = JobApplication::with('career')->orderBy('id', 'DESC')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $jobApplicationCategories = Career::published()->get();
        $careers = Career::published()->get();
        $types = GenderTypeEnum::cases();

        return view('backend.jobApplication.create', compact('jobApplicationCategories', 'careers', 'types'));
    }

    public function destroy(JobApplication $jobApplication)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/jobApplication/' . $jobApplication->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $jobApplication->delete();

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
            $jobApplication = JobApplication::whereId($id)->update([
                'is_scanned' => $request->is_scanned == 'true' ? 1 : 0,
            ]);

            DB::commit();

            return $jobApplication;
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function markAsShortlisted($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $jobApplication = JobApplication::whereId($id)->update([
                'is_shortlisted' => $request->is_shortlisted == 'true' ? 1 : 0,
            ]);

            DB::commit();

            return $jobApplication;
        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function show(JobApplication $jobApplication)
    {
        try {
            $jobApplication->load('career');

            return view('backend.jobApplication.view', compact('jobApplication'));
        } catch (Exception $e) {
            Log::error('JobApplication view error: ' . $e->getMessage());
            abort(404, 'JobApplication not found');
        }
    }

    public function update(JobApplicationRequest $request, JobApplication $jobApplication)
    {
        DB::beginTransaction();

        try {
            $jobApplication->update([
                'remarks' => $request->remarks,
                'is_scanned' => $request->is_scanned,
                'is_shortlisted' => $request->is_shortlisted,
            ]);
            DB::commit();

            Session::flash('success', 'Job Application updated successfully.');

            return redirect()->route('job-application.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function excelExport(Request $request)
    {
        try {
            $career = Career::find($request->career_id);

            $otherGenderValue = GenderTypeEnum::OTHERS->value;
            $query = DB::table('job_applications')
                ->select([
                    DB::raw('ROW_NUMBER() OVER (ORDER BY job_applications.id DESC) AS s_n'),
                    'careers.name_en as career',
                    'job_applications.full_name',
                    DB::raw("
                        CASE
                            WHEN job_applications.gender = '{$otherGenderValue}'
                            THEN job_applications.other_gender
                            ELSE job_applications.gender
                        END AS gender
                    "),
                    'job_applications.date_of_birth_ad',
                    'job_applications.date_of_birth_bs',
                    'job_applications.age',
                    'job_applications.current_address',
                    'job_applications.mobile_number',
                    'job_applications.email',
                    'job_applications.phone_no',
                    'job_applications.highest_education_qualification',
                    'job_applications.cover_letter',
                    'job_applications.cv',
                ])
                ->where([
                    'is_scanned' => $request->is_scanned,
                    'is_shortlisted' => $request->is_shortlisted
                ]);

            if ($request->career_id != 'all') {
                $query = $query->where('career_id', $request->career_id);
            }

            $jobApplications = $query
                ->leftJoin('careers', 'careers.id', '=', 'job_applications.career_id')
                ->get();

            $jobApplications = $jobApplications->map(function ($item) {
                $item->gender = GenderTypeEnum::map($item->gender);
                return $item;
            });

            $export = new JobApplicationExport($jobApplications);
            $name = 'JobApplication(' . ($career->name_en ?? "All") . ').xlsx';

            Session::flash('success', 'Excel exported for Job Application successfully.');

            return Excel::download($export, $name);
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}
