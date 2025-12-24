<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Volunteer;
use Illuminate\Support\Str;
use App\Mail\VolunteerMail;
use App\Enum\GenderTypeEnum;
use App\Models\VolunteerForm;
use Illuminate\Support\Facades\DB;
use App\Enum\DailyAvailabilityEnum;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\Frontend\VolunteerFormRequest;
use App\Models\Setting;

class VolunteerFormController extends Controller
{
    public function volunteerPage()
    {
        $volunteer = Volunteer::first();
        $types = GenderTypeEnum::cases();
        $dailyAvailabilitytypes = DailyAvailabilityEnum::cases();

        return view('frontend.volunteer.volunteer', compact('volunteer', 'types', 'dailyAvailabilitytypes'));
    }

    public function store(VolunteerFormRequest $request)
    {
        DB::beginTransaction();

        try {
            $volunteerForm = VolunteerForm::create([
                'full_name' => $request->full_name,
                'date_of_birth_ad' => $request->date_of_birth_ad,
                'date_of_birth_bs' => $request->date_of_birth_bs,
                'age' => $request->age,
                'gender' => $request->gender,
                'other_gender' => $request->other_gender,
                'nationality' => $request->nationality,
                'passport_number' => $request->passport_number,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
                'current_address' => $request->current_address,
                'emergency_full_name' => $request->emergency_full_name,
                'emergency_relationship' => $request->emergency_relationship,
                'emergency_contact_number' => $request->emergency_contact_number,
                'emergency_email' => $request->emergency_email,
                'area_of_interest' => $request->area_of_interest,
                'skill_experties' => $request->skill_experties,
                'motivation' => $request->motivation,
                'previous_volunteer_experience' => $request->previous_volunteer_experience,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'daily_availability' => $request->daily_availability,
                'accomodation_required' => $request->accomodation_required,
                'dietary_restriction' => $request->dietary_restriction,
                'medical_condition' => $request->medical_condition,
                'medical_description' => $request->medical_description,
                'travel_insurance' => $request->travel_insurance,
                'criminal_record' => $request->criminal_record,
                'aggrement' => $request->aggrement,
            ]);

            $insuranceProofPath = '';
            if ($request->hasFile('insurance_proof')) {
                $file = $request->file('insurance_proof');
                $filename = time() . '_' . $file->getClientOriginalName();

                $relativePath = 'uploads/volunteer_form/' . $volunteerForm->id . '/insurance_proof/';
                $destinationPath = public_path($relativePath);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $filename);
                $insuranceProofPath = $relativePath . $filename;
            }
            $volunteerForm->update([
                'insurance_proof' => $insuranceProofPath,
            ]);

            $cvPath = null;
            if ($request->hasFile('cv')) {
                $file = $request->file('cv');
                $filename = time() . '_' . $file->getClientOriginalName();

                $relativePath = 'uploads/volunteer_form/' . $volunteerForm->id . '/cv/';
                $destinationPath = public_path($relativePath);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $filename);
                $cvPath = $relativePath . $filename;
            }
            $volunteerForm->update([
                'cv' => $cvPath,
            ]);

            $passportPath = [];
            if ($request->hasFile('passport_copy')) {
                $image = $request->file('passport_copy');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $passportPath = 'uploads/volunteer_form/' . $volunteerForm->id . '/passport_copy/' . $filename;

                $directory = public_path('uploads/volunteer_form/' . $volunteerForm->id . '/passport_copy/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }
            $volunteerForm->update([
                'passport_copy' => $passportPath,
            ]);

            $visaPath = [];
            if ($request->hasFile('visa_copy')) {
                $image = $request->file('visa_copy');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $visaPath = 'uploads/volunteer_form/' . $volunteerForm->id . '/visa_copy/' . $filename;

                $directory = public_path('uploads/volunteer_form/' . $volunteerForm->id . '/visa_copy/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }
            $volunteerForm->update([
                'visa_copy' => $visaPath,
            ]);

            $signPath = [];
            if ($request->hasFile('digital_signature')) {
                $image = $request->file('digital_signature');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $signPath = 'uploads/volunteer_form/' . $volunteerForm->id . '/digital_signature/' . $filename;

                $directory = public_path('uploads/volunteer_form/' . $volunteerForm->id . '/digital_signature/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }
            $volunteerForm->update([
                'digital_signature' => $signPath,
            ]);

            DB::commit();

            $setting = Setting::first();

            if (!empty($setting->admission_notify_email)) {
                Mail::to($setting->admission_notify_email)->send(new VolunteerMail($volunteerForm));
            }

            Session::flash('success', 'Volunteer Form created successfully.');

            return redirect()->route('volunteer-page.show');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}
