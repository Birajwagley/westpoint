<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class SettingController extends BaseController
{
    public function edit()
    {
        $setting = Setting::find(1);

        return view('backend.setting.edit', compact('setting'));
    }

    public function update(SettingRequest $request)
    {
        DB::beginTransaction();
        try {
            $setting = Setting::find(1);

            $primaryLogoPath = $setting->primary_logo;
            if ($request->hasFile('primary_logo')) {
                // Delete old image
                if ($setting->primary_logo && file_exists(public_path($setting->primary_logo))) {
                    unlink(public_path($setting->primary_logo));
                }

                $image = $request->file('primary_logo');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $primaryLogoPath = 'uploads/setting/primary_logo/' . $filename;

                $directory = public_path('uploads/setting/primary_logo/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }

            $secondaryLogoPath = $setting->secondary_logo;
            if ($request->hasFile('secondary_logo')) {
                // Delete old image
                if ($setting->secondary_logo && file_exists(public_path($setting->secondary_logo))) {
                    unlink(public_path($setting->secondary_logo));
                }

                $image = $request->file('secondary_logo');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $secondaryLogoPath = 'uploads/setting/secondary_logo/' . $filename;

                $directory = public_path('uploads/setting/secondary_logo/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }


            $experienceLogoPath = $setting->experience_logo;
            if ($request->hasFile('experience_logo')) {
                // Delete old image
                if ($setting->experience_logo && file_exists(public_path($setting->experience_logo))) {
                    unlink(public_path($setting->experience_logo));
                }

                $image = $request->file('experience_logo');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $experienceLogoPath = 'uploads/setting/experience_logo/' . $filename;

                $directory = public_path('uploads/setting/experience_logo/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }

            $faviconPath = $setting->favicon;
            if ($request->hasFile('favicon')) {
                // Delete old image
                if ($setting->favicon && file_exists(public_path($setting->favicon))) {
                    unlink(public_path($setting->favicon));
                }

                $image = $request->file('favicon');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $faviconPath = 'uploads/setting/favicon/' . $filename;

                $directory = public_path('uploads/setting/favicon/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }

            $schoolOverviewImagePath = $setting->school_overview_image;
            if ($request->hasFile('school_overview_image')) {
                // Delete old image
                if ($setting->school_overview_image && file_exists(public_path($setting->school_overview_image))) {
                    unlink(public_path($setting->school_overview_image));
                }

                $image = $request->file('school_overview_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $schoolOverviewImagePath = 'uploads/setting/school_overview_image/' . $filename;

                $directory = public_path('uploads/setting/school_overview_image/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }

            $emails = [];
            foreach ($request->name_email as $key => $name) {
                $emails[] = [
                    'name' => $name,
                    'email' => $request->emails[$key],
                ];
            }

            $contacts = [];
            foreach ($request->name_contact as $key => $name) {
                $contacts[] = [
                    'name' => $name,
                    'contact' => $request->contacts[$key],
                ];
            }

            $setting->update([
                'primary_logo' => $primaryLogoPath,
                'secondary_logo' => $secondaryLogoPath,
                'experience_logo' => $experienceLogoPath,
                'favicon' => $faviconPath,
                'school_overview_image' => $schoolOverviewImagePath,
                'title_en' => $request->title_en,
                'title_np' => $request->title_np,
                'address_en' => $request->address_en,
                'address_np' => $request->address_np,
                'admission_notify_email' => $request->admission_notify_email,
                'career_notify_email' => $request->career_notify_email,
                'volunteer_notify_email' => $request->volunteer_notify_email,
                'feedback_notify_email' => $request->feedback_notify_email,
                'map' => $request->map,
                'contacts' => $contacts,
                'emails' => $emails,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'x' => $request->x,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'youtube_video' => $request->youtube_video,
                'schema_markup' => $request->schema_markup,
                'canonical_url' => $request->canonical_url,
                'keywoard' => $request->keywoard,
                'school_hour_en' => $request->school_hour_en,
                'school_hour_np' => $request->school_hour_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
            ]);

            DB::commit();
            Session::flash('success', 'Setting updated successfully.');
            return redirect()->route('setting.edit');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back()->withInput();
        }
    }

    public function getEmails()
    {
        $index = request()->index;

        return view('backend.setting.partials.emails', compact('index'));
    }

    public function getContacts()
    {
        $index = request()->index;

        return view('backend.setting.partials.contacts', compact('index'));
    }
}
