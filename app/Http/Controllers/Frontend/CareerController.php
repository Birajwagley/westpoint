<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Career;
use App\Enum\GenderTypeEnum;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Frontend\JobApplicationRequest;
use App\Mail\CareerMail;
use App\Models\Setting;

class CareerController extends Controller
{
    public function careerPage()
    {
        $careers = Career::published()->get();

        return view('frontend.career.career', compact('careers'));
    }

    public function careerDetails($slug = null)
    {
        if ($slug) {
            $career = Career::published()->with('designation')->where('slug', $slug)->firstOrFail();

            $jobApplicationCategories = Career::published()->get();
            $types = GenderTypeEnum::cases();

            return view('frontend.career.career-details', compact('career', 'types', 'jobApplicationCategories'));
        }

        return redirect()->route('career');
    }

    public function store(JobApplicationRequest $request)
    {
        DB::beginTransaction();
        try {
            $jobApplication = JobApplication::create([
                'career_id' => $request->career_id,
                'full_name' => $request->full_name,
                'gender' => $request->gender,
                'other_gender' => $request->other_gender,
                'date_of_birth_ad' => $request->date_of_birth_ad,
                'date_of_birth_bs' => $request->date_of_birth_bs,
                'age' => $request->age,
                'current_address' => $request->current_address,
                'mobile_number' => $request->mobile_number,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'highest_education_qualification' => $request->highest_education_qualification,
                'cover_letter' => $request->cover_letter,
            ]);

            $filePath = '';
            if ($request->hasFile('cv')) {
                $file = $request->file('cv');
                $filename = time() . '_' . $file->getClientOriginalName();

                $relativePath = 'uploads/jobApplication/' . $jobApplication->id . '/cv/';
                $destinationPath = public_path($relativePath);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $filePath = $relativePath . $filename;

                $file->move($destinationPath, $filename);
            }

            $jobApplication->update([
                'cv' => $filePath,
            ]);

            DB::commit();

            $setting = Setting::first();

            if (!empty($setting->admission_notify_email)) {
                Mail::to($setting->admission_notify_email)->send(new CareerMail($jobApplication));
            }
            Session::flash('success', 'JobApplication created successfully.');

            return redirect()->route('career');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}
