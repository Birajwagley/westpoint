<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Classes;
use Illuminate\Support\Str;
use App\Models\AcademicLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\AcademicLevelRequest;
use App\Http\Controllers\Backend\BaseController;

class AcademicLevelController extends BaseController
{
    public function index()
    {
        return view('backend.academic-level.index');
    }

    public function academicLevelData()
    {
        $datas = AcademicLevel::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = AcademicLevel::orderBy('display_order', 'desc')->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;
        $classes = Classes::published()->get();

        return view('backend.academic-level.create', compact('displayOrder', 'classes'));
    }

    public function store(AcademicLevelRequest $request)
    {
        DB::beginTransaction();
        try {
            $academicLevel = AcademicLevel::create([
                'slug' => $request->slug,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'icon' => $request->icon,
                'tagline_en' => $request->tagline_en,
                'tagline_np' => $request->tagline_np,
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
            ]);

            $thumnailImagePath = null;
            if ($request->hasFile('thumbnail_image')) {
                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $thumnailImagePath = 'uploads/academic_level/' . $academicLevel->id . '/thumbnails/' . $filename;

                $directory = public_path('uploads/academic_level/' . $academicLevel->id . '/thumbnails/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);
            }

            $imagePath = null;
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $image = $file;
                    $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $path = 'uploads/academic_level/' . $academicLevel->id . '/images/' . $filename;

                    // Save the file
                    File::put($path, file_get_contents($file));

                    // Save resized image using Intervention v3
                    $manager = new ImageManager(new Driver());
                    $manager->read($image)->save($directory . $filename);

                    $imagePath[] = $path;
                }
            }

            $academicLevel->update([
                'thumbnail_image' => $thumnailImagePath,
                'images' => $imagePath,
            ]);

            $academicLevel->classes()->attach($request->class_id);

            DB::commit();

            Session::flash('success', 'Academic Level created successfully.');

            return redirect()->route('academic-level.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(AcademicLevel $academicLevel)
    {
        $academicLevel->load('classes');

        $classes = Classes::published()->get();

        return view('backend.academic-level.edit', compact('academicLevel', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademicLevelRequest $request, AcademicLevel $academicLevel)
    {
        DB::beginTransaction();
        try {
            $academicLevel->update([
                'slug' => $request->slug,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'icon' => $request->icon,
                'tagline_en' => $request->tagline_en,
                'tagline_np' => $request->tagline_np,
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
            ]);

            if ($request->hasFile('thumbnail_image')) {
                // Delete old image
                if ($academicLevel->thumbnail_image && file_exists(public_path($academicLevel->thumbnail_image))) {
                    unlink(public_path($academicLevel->thumbnail_image));
                }

                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $thumnailImagePath = 'uploads/academic_level/' . $academicLevel->id . '/thumbnails/' . $filename;

                $directory = public_path('uploads/academic_level/' . $academicLevel->id . '/thumbnails/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);

                $academicLevel->update([
                    'thumbnail_image' => $thumnailImagePath,
                ]);
            }

            $imagePath = json_decode($academicLevel->images, true) ?? [];

            if ($request->hasFile('images')) {
                $directory = public_path('uploads/academic_level/' . $academicLevel->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                foreach ($request->file('images') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = 'uploads/academic_level/' . $academicLevel->id . '/images/' . $filename;

                    // Save the file
                    File::put($path, file_get_contents($file));

                    // Save resized image using Intervention
                    $manager = new ImageManager(new Driver());
                    $manager->read($file)->save($directory . $filename);

                    $imagePath[] = $path; // append new image
                }
            }

            $academicLevel->update([
                'images' => $imagePath,
            ]);

            $academicLevel->classes()->sync($request->class_id);

            DB::commit();
            Session::flash('success', 'Academic Level updated successfully.');
            return redirect()->route('academic-level.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function deleteImage(AcademicLevel $academicLevel, $imageIndex)
    {
        DB::beginTransaction();
        try {
            $images = json_decode($academicLevel->images, true);
            // Remove the selected image based on its index
            if (isset($images[$imageIndex])) {
                $imagePath = $images[$imageIndex];
                unset($images[$imageIndex]);

                // Delete the image from storage
                File::delete($imagePath);

                // Update the gallery with the remaining images
                $academicLevel->update([
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicLevel $academicLevel)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/academic_level/' . $academicLevel->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $academicLevel->classes()->detach();

            $academicLevel->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
