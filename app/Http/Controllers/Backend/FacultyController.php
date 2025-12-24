<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Group;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\FacultyGroupSubject;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\FacultyRequest;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;
use App\Http\Requests\FacultyGroupSubjectRequest;

class FacultyController extends BaseController
{
    public function index()
    {
        return view('backend.faculty.index');
    }

    public function facultyData()
    {
        $datas = Faculty::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Faculty::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $subjects = Subject::published()->get();
        $groups = Group::published()->displayOrder()->get();

        return view('backend.faculty.create', compact('displayOrder', 'subjects', 'groups'));
    }

    public function store(FacultyRequest $request)
    {
        DB::beginTransaction();
        try {
            $faculty = Faculty::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'is_featured' => $request->is_featured,
                'is_published' => $request->is_published,
                'display_order' => $request->display_order,
            ]);

            $thumnailImagePath = null;
            if ($request->hasFile('thumbnail_image')) {
                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $thumnailImagePath = 'uploads/faculty/' . $faculty->id . '/thumbnails/' . $filename;

                $directory = public_path('uploads/faculty/' . $faculty->id . '/thumbnails/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);
            }

            $imagePath = json_decode($faculty->images, true) ?? [];

            if ($request->hasFile('images')) {
                $directory = public_path('uploads/faculty/' . $faculty->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                foreach ($request->file('images') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = 'uploads/faculty/' . $faculty->id . '/images/' . $filename;

                    // Save the file
                    File::put($path, file_get_contents($file));

                    // Save resized image using Intervention
                    $manager = new ImageManager(new Driver());
                    $manager->read($file)->save($directory . $filename);

                    $imagePath[] = $path; // append new image
                }
            }

            $faculty->update([
                'thumbnail_image' => $thumnailImagePath,
                'images' => $imagePath,
            ]);

            DB::commit();

            Session::flash('success', 'Faculty created successfully.');

            return redirect()->route('faculty.edit', $faculty->id);
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Faculty $faculty)
    {
        $faculty->load('groupSubjectFaculties');

        $subjects = Subject::published()->get();
        $groups = Group::published()->displayOrder()->get();

        return view('backend.faculty.edit', compact('faculty', 'subjects', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultyRequest $request, Faculty $faculty)
    {
        DB::beginTransaction();
        try {
            $faculty->update([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'is_featured' => $request->is_featured,
                'is_published' => $request->is_published,
                'display_order' => $request->display_order,
            ]);

            if ($request->hasFile('thumbnail_image')) {
                // Delete old image
                if ($faculty->thumbnail_image && file_exists(public_path($faculty->thumbnail_image))) {
                    unlink(public_path($faculty->thumbnail_image));
                }

                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $thumnailImagePath = 'uploads/faculty/' . $faculty->id . '/thumbnails/' . $filename;

                $directory = public_path('uploads/faculty/' . $faculty->id . '/thumbnails/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);

                $faculty->update([
                    'thumbnail_image' => $thumnailImagePath,
                ]);
            }

            $imagePath = json_decode($faculty->images, true) ?? [];

            if ($request->hasFile('images')) {
                $directory = public_path('uploads/faculty/' . $faculty->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                foreach ($request->file('images') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = 'uploads/faculty/' . $faculty->id . '/images/' . $filename;

                    // Save the file
                    File::put($path, file_get_contents($file));

                    // Save resized image using Intervention
                    $manager = new ImageManager(new Driver());
                    $manager->read($file)->save($directory . $filename);

                    $imagePath[] = $path; // append new image
                }
            }

            $faculty->update([
                'images' => $imagePath,
            ]);

            DB::commit();
            Session::flash('success', 'Faculty updated successfully.');
            return redirect()->route('faculty.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function deleteImage(Faculty $faculty, $imageIndex)
    {
        DB::beginTransaction();
        try {
            $images = json_decode($faculty->images, true);
            // Remove the selected image based on its index
            if (isset($images[$imageIndex])) {
                $imagePath = $images[$imageIndex];
                unset($images[$imageIndex]);

                // Delete the image from storage
                File::delete($imagePath);

                // Update the gallery with the remaining images
                $faculty->update([
                    'images' => json_encode($images),
                ]);

                DB::commit();
                return response()->json(['status' => true, 'message' => 'Image deleted successfully.']);
            }

            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Image not found.']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => 'Sorry, there was an error.']);
        }
    }

    public function destroy(Faculty $faculty)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/faculty/' . $faculty->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $faculty->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }

    public function facultyGroupSubject(FacultyGroupSubjectRequest $request, Faculty $faculty)
    {
        DB::beginTransaction();
        try {
            $faculty->groupSubjectFaculties()->delete();

            foreach ($request->subject_id as $key => $subject) {
                if ($subject != null) {
                    if (gettype($subject) == 'array') {
                        foreach ($subject as $sub) {
                            FacultyGroupSubject::create([
                                'faculty_id' => $faculty->id,
                                'group_id' => $request['group_id'][$key],
                                'subject_id' => $sub,
                            ]);
                        }
                    } else {
                        FacultyGroupSubject::create([
                            'faculty_id' => $faculty->id,
                            'group_id' => $request['group_id'][$key],
                            'subject_id' => $subject,
                        ]);
                    }
                }
            }

            DB::commit();

            Session::flash('success', 'Group and Subject for Faculty saved successfully.');

            return redirect()->route('faculty.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}
