<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\AlumniForm;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Enum\PerspectiveFromEnum;
use Illuminate\Support\Facades\DB;
use App\Enum\AlumniSectionTypeEnum;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AlumniFormRequest;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class AlumniFormController extends BaseController
{
    public function index()
    {
        return view('backend.alumni-form.index');
    }

    public function alumniFormData()
    {
        $datas = AlumniForm::orderBy('id', 'DESC')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $countries = countries();
        $sectionType = AlumniSectionTypeEnum::cases();

        return view('backend.alumni-form.create', compact('countries', 'sectionType'));
    }

    public function store(AlumniFormRequest $request)
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
                'section_type' => $request->section_type,
                'is_published' => $request->is_published,
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
                $manager->read($image)
                    ->save($directory . $filename);
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
                $manager->read($image)
                    ->save($directory . $filename);
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

            Session::flash('success', 'Alumni Form created successfully.');

            return redirect()->route('alumni-form.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function show(AlumniForm $alumniForm)
    {
        $sectionType = AlumniSectionTypeEnum::cases();

        try {
            return view('backend.alumni-form.view', compact('alumniForm', 'sectionType'));
        } catch (Exception $e) {
            Log::error('Alumni Form view error: ' . $e->getMessage());
            abort(404, 'Alumni Form not found');
        }
    }

    public function update(AlumniFormRequest $request, AlumniForm $alumniForm)
    {
        DB::beginTransaction();

        try {
            $alumniForm->update([
                'section_type' => $request->section_type,
                'is_published' => $request->is_published,
            ]);

            $alumniForm->testimonial->update([
                'testimonial_video' => $request->testimonial_video,
            ]);

            DB::commit();

            Session::flash('success', 'Alumni Form updated successfully.');

            return redirect()->route('alumni-form.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(AlumniForm $alumniForm)
    {
        DB::beginTransaction();
        try {
            $alumniForm->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
