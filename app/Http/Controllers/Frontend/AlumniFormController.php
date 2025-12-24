<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Alumni;
use App\Models\AlumniForm;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Enum\PerspectiveFromEnum;
use Illuminate\Support\Facades\DB;
use App\Enum\AlumniSectionTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AlumniFormFrontendRequest;
use App\Mail\AlumniMail;
use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;

class AlumniFormController extends Controller
{
    public function alumni()
    {
        $sections = [];

        foreach (AlumniSectionTypeEnum::cases() as $case) {
            $sections[$case->value] = AlumniForm::where('section_type', $case->value)->where('is_published', true)->latest()->get();
        }
        $sectionLabels = AlumniSectionTypeEnum::map();
        $countries = countries();

        $alumnidescription = Alumni::whereId(1)->first();
        $links = $alumnidescription->links;

        return view('frontend.alumni', compact('sections', 'sectionLabels', 'countries', 'alumnidescription', 'links'));
    }

    public function store(AlumniFormFrontendRequest $request)
    {
        DB::beginTransaction();
        try {
            $alumniForm = AlumniForm::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'occupation' => $request->occupation,
                'designation' => $request->designation,
                'batch' => $request->batch,
                'country' => $request->country,
            ]);

            $companyLogoPath = '';
            if ($request->hasFile('company_logo')) {
                $image = $request->file('company_logo');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $companyLogoPath = 'uploads/alumniForm/' . $alumniForm->id . '/companyLogo/' . $filename;

                $directory = public_path('uploads/alumniForm/' . $alumniForm->id . '/companyLogo/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }

            $alumniForm->update([
                'company_logo' => $companyLogoPath,
            ]);

            $imagePath = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/alumniForm/' . $alumniForm->id . '/image/' . $filename;

                $directory = public_path('uploads/alumniForm/' . $alumniForm->id . '/image/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }

            Testimonial::create([
                'perspective_from' => PerspectiveFromEnum::ALUMNI,
                'alumni_form_id' => $alumniForm->id,
                'image' => $imagePath,
                'full_name' => $request->full_name,
                'testimonial_text' => $request->testimonial_text,
                'testimonial_video' => $request->testimonial_video,
            ]);
            DB::commit();

            $setting = Setting::first();

            if (!empty($setting->admission_notify_email)) {
                Mail::to($setting->admission_notify_email)->send(new AlumniMail($alumniForm));
            }

            Session::flash('success', 'Alumni Form created successfully.');

            return redirect()->route('alumni.alumni')->with('success', 'Alumni Form created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again.');
            return redirect()->back();
        }
    }
}
