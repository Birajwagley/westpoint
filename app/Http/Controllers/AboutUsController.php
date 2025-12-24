<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\AboutUs;
use App\Models\AboutUsCard;
use Illuminate\Support\Str;
use App\Models\AboutUsCronology;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\AboutUsRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AboutUsCardRequest;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\AboutUsCronologyRequest;
use App\Http\Controllers\Backend\BaseController;

class AboutUsController extends BaseController
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $aboutUs = AboutUs::first();
        $cronologies = AboutUsCronology::all();
        $cards = AboutUsCard::all();

        return view('backend.about-us.edit', compact('aboutUs', 'cronologies', 'cards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAboutUs(AboutUsRequest $request)
    {
        DB::beginTransaction();
        try {
            $aboutUs = AboutUs::first();

            $aboutUs->update([
                'title_en' => $request->title_en,
                'title_np' => $request->title_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'mission_en' => $request->mission_en,
                'mission_np' => $request->mission_np,
                'vision_en' => $request->vision_en,
                'vision_np' => $request->vision_np,
            ]);

            if ($request->hasFile('image_one')) {
                $image = $request->file('image_one');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/about-us/' . $filename;

                $directory = public_path('uploads/about-us/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)
                    ->save($directory . $filename);
                $aboutUs->update([
                    'image_one' => $path,
                ]);
            }

            if ($request->hasFile('image_two')) {
                $image = $request->file('image_two');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/about-us/' . $filename;

                $directory = public_path('uploads/about-us/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)
                    ->save($directory . $filename);

                $aboutUs->update([
                    'image_two' => $path,
                ]);
            }

            if ($request->hasFile('image_three')) {
                $image = $request->file('image_three');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/about-us/' . $filename;

                $directory = public_path('uploads/about-us/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)
                    ->save($directory . $filename);

                $aboutUs->update([
                    'image_three' => $path,
                ]);
            }

            DB::commit();

            Session::flash('success', 'About Us updated successfully.');

            return redirect()->route('aboutus.edit');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function updateCronology(AboutUsCronologyRequest $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->cronology_name_en as $key => $name) {
                AboutUsCronology::updateOrCreate(
                    [
                        'id' => $request->id[$key],
                    ],
                    [
                        'name_en' => $name,
                        'name_np' => $request->cronology_name_np[$key],
                        'date_en' => $request->cronology_date_en[$key],
                        'date_np' => $request->cronology_date_np[$key],
                        'description_en' => $request->cronology_description_en[$key],
                        'description_np' => $request->cronology_description_np[$key],
                    ]
                );
            }

            DB::commit();

            Session::flash('success', 'Cronology updated successfully.');

            return redirect()->route('aboutus.edit');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function updateCard(AboutUsCardRequest $request)
    {
        DB::beginTransaction();
        try {
            foreach ($request->card_name_en as $key => $name) {
                $aboutUsCard = AboutUsCard::updateOrCreate(
                    [
                        'id' => $request->id[$key],
                    ],
                    [
                        'name_en' => $name,
                        'name_np' => $request->card_name_np[$key],
                        'link' => $request->card_link[$key],
                        'short_description_en' => $request->card_short_description_en[$key],
                        'short_description_np' => $request->card_short_description_np[$key],
                    ]
                );

                if ($request->hasFile('card_image.' . $key)) {
                    $image = $request->file('card_image.' . $key);
                    $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $path = 'uploads/about-us/card/' . $aboutUsCard->id . '/' . $filename;

                    $directory = public_path('uploads/about-us/card/' . $aboutUsCard->id . '/');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0755, true);
                    }

                    // Save resized image using Intervention v3
                    $manager = new ImageManager(new Driver());
                    $manager->read($image)
                        ->save($directory . $filename);

                    $aboutUsCard->update([
                        'image' => $path,
                    ]);
                }
            }

            DB::commit();

            Session::flash('success', 'Card updated successfully.');

            return redirect()->route('aboutus.edit');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function getCronologyDetail()
    {
        $index = request()->index + 1;

        return view('backend.about-us.partials.cronology.detail', compact('index'));
    }

    public function getCardDetail()
    {
        $index = request()->index + 1;

        return view('backend.about-us.partials.card.detail', compact('index'));
    }
}
