<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Enum\AwardTypeEnum;
use Illuminate\Support\Str;
use App\Models\AwardRecognition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Enum\AwardAchivementTypeEnum;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\AwardRecognitionRequest;
use App\Http\Controllers\Backend\BaseController;

class AwardRecognitionController extends BaseController
{
    public function index()
    {
        return view('backend.award-recognition.index');
    }

    public function awardRecognitonData()
    {
        $datas = AwardRecognition::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }
    public function create()
    {
        $displayOrder = AwardRecognition::orderBy('display_order', 'desc')->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;
        $types = AwardAchivementTypeEnum::cases();
        $awardTypes = AwardTypeEnum::cases();

        return view('backend.award-recognition.create', compact('displayOrder', 'types', 'awardTypes'));
    }

    public function store(AwardRecognitionRequest $request)
    {
        DB::beginTransaction();

        try {
            $awardRecognition = AwardRecognition::create([
                'type' => $request->type,
                'award_type' => $request->award_type,
                'title_en' => $request->title_en,
                'title_np' => $request->title_np,
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'display_order' => $request->display_order,
                'is_featured' => $request->is_featured,
                'is_published' => $request->is_published,
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/award-recognition/' . $awardRecognition->id . '/images/' . $filename;

                $directory = public_path('uploads/award-recognition/' . $awardRecognition->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);
            }

            $awardRecognition->update([
                'image' => $imagePath,
            ]);

            DB::commit();

            Session::flash('success', 'Awards Recognition created successfully.');
            return redirect()->route('award-recognition.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
    public function edit(AwardRecognition $awardRecognition)
    {
        $types = AwardAchivementTypeEnum::cases();
        $awardTypes = AwardTypeEnum::cases();

        return view('backend.award-recognition.edit', compact('awardRecognition', 'types', 'awardTypes'));
    }

    public function update(AwardRecognitionRequest $request, AwardRecognition $awardRecognition)
    {
        DB::beginTransaction();

        try {
            $awardRecognition->update([
                'type' => $request->type,
                'award_type' => $request->award_type,
                'title_en' => $request->title_en,
                'title_np' => $request->title_np,
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'display_order' => $request->display_order,
                'is_featured' => $request->is_featured,
                'is_published' => $request->is_published,
            ]);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($awardRecognition->image && file_exists(public_path($awardRecognition->image))) {
                    unlink(public_path($awardRecognition->image));
                }

                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/award-recognition/' . $awardRecognition->id  . '/images/' . $filename;

                $directory = public_path('uploads/award-recognition/' . $awardRecognition->id  . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)
                    ->save($directory . $filename);

                $awardRecognition->update([
                    'image' => $imagePath,
                ]);
            }

            DB::commit();

            Session::flash('success', 'Award Recognition updated successfully.');

            return redirect()->route('award-recognition.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(AwardRecognition $awardRecognition)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/award-recognition/' . $awardRecognition->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $awardRecognition->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
