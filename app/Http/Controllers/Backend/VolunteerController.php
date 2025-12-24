<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Volunteer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\VolunteerRequest;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class VolunteerController extends BaseController
{
    public function edit()
    {
        $volunteer = Volunteer::first();

        return view('backend.volunteer.edit', compact('volunteer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VolunteerRequest $request)
    {
        DB::beginTransaction();
        try {
            $volunteer = Volunteer::first();

            $volunteer->update([
                'qualification_en' => $request->qualification_en,
                'qualification_np' => $request->qualification_np,
                'need_of_volunteer_en' => $request->need_of_volunteer_en,
                'need_of_volunteer_np' => $request->need_of_volunteer_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
            ]);

            $imagePath = json_decode($volunteer->images, true) ?? null;

            if ($request->hasFile('images')) {
                $directory = public_path('uploads/volunteer/' . $volunteer->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                foreach ($request->file('images') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = 'uploads/volunteer/' . $volunteer->id . '/images/' . $filename;

                    // Save the file
                    File::put($path, file_get_contents($file));

                    // Save resized image using Intervention
                    $manager = new ImageManager(new Driver());
                    $manager->read($file)->save($directory . $filename);

                    $imagePath[] = $path; // append new image
                }
            }

            $volunteer->update([
                'images' => $imagePath,
            ]);

            DB::commit();
            Session::flash('success', 'Volunteer updated successfully.');

            return redirect()->route('volunteer.edit');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function deleteImage(Volunteer $volunteer, $imageIndex)
    {
        DB::beginTransaction();
        try {
            $images = json_decode($volunteer->images, true);
            // Remove the selected image based on its index
            if (isset($images[$imageIndex])) {
                $imagePath = $images[$imageIndex];
                unset($images[$imageIndex]);

                $images = count($images) == 0 ? null : $images;

                // Delete the image from storage
                File::delete($imagePath);

                // Update the gallery with the remaining images
                $volunteer->update([
                    'images' => $images == null ? null : json_encode($images),
                ]);

                DB::commit();
                return response()->json(['status' => true, 'message' => 'Image deleted successfully.', 'images' => $images]);
            }

            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Image not found.']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Sorry, there was an error.']);
        }
    }

    public function destroy(Volunteer $volunteer)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/volunteer/' . $volunteer->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $volunteer->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
