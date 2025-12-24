<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Gallery;
use App\Enum\DistrictEnum;
use Illuminate\Support\Str;
use App\Enum\GalleryTypeEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class GalleryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.gallery.index');
    }

    public function galleryData()
    {
        $datas = Gallery::displayOrder()->get();

        return response()->json(['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $displayOrder = Gallery::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $types = GalleryTypeEnum::cases();
        $districts = DistrictEnum::cases();

        return view('backend.gallery.create', compact('displayOrder', 'types', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        DB::beginTransaction();
        try {
            $gallery = Gallery::create([
                'type' => $request->type,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'slug' => $this->checkUnique($request, null, 'galleries'),
                'value' => $request->type == GalleryTypeEnum::VIDEO->value ? $request->video_link : null,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
            ]);

            $coverImagePath = null;
            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $coverImagePath = 'uploads/gallery/' . $gallery->id . '/cover_image/' . $filename;

                $directory = public_path('uploads/gallery/' . $gallery->id . '/cover_image/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }

            $gallery->update([
                'cover_image' => $coverImagePath,
            ]);

            if ($request->type == GalleryTypeEnum::IMAGE->value) {
                $imagePath = [];
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $file) {
                        $image = $file;
                        $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                        $imagePath[] = 'uploads/gallery/' . $gallery->id . '/images/' . $filename;

                        $directory = public_path('uploads/gallery/' . $gallery->id . '/images/');
                        if (!File::exists($directory)) {
                            File::makeDirectory($directory, 0755, true);
                        }

                        // Save resized image using Intervention v3
                        $manager = new ImageManager(new Driver());
                        $manager->read($image)->save($directory . $filename);
                    }
                }

                $gallery->update([
                    'cover_image' => $coverImagePath,
                    'value' => $imagePath,
                ]);
            }

            DB::commit();

            Session::flash('success', 'Gallery created successfully.');

            return redirect()->route('gallery.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $types = GalleryTypeEnum::cases();
        $districts = DistrictEnum::cases();

        return view('backend.gallery.edit', compact('gallery', 'types', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        DB::beginTransaction();
        try {
            $gallery->update([
                'type' => $request->type,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'slug' => $gallery->slug == $request->slug ? $gallery->slug : $this->checkUnique($request, $gallery->id, 'gallery'),
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
            ]);

            $coverImagePath = null;
            if ($request->hasFile('cover_image')) {
                if ($gallery->cover_image && file_exists(public_path($gallery->cover_image))) {
                    unlink(public_path($gallery->cover_image));
                }

                $image = $request->file('cover_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $coverImagePath = 'uploads/gallery/' . $gallery->id . '/cover_image/' . $filename;

                $directory = public_path('uploads/gallery/' . $gallery->id . '/cover_image/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);

                $gallery->update([
                    'cover_image' => $coverImagePath,
                ]);
            }

            $imagePath = json_decode($gallery->value, true) ?? null;
            if ($request->hasFile('images')) {
                $directory = public_path('uploads/gallery/' . $gallery->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                foreach ($request->file('images') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = 'uploads/gallery/' . $gallery->id . '/images/' . $filename;

                    // Save the file
                    File::put($path, file_get_contents($file));

                    // Save resized image using Intervention
                    $manager = new ImageManager(new Driver());
                    $manager->read($file)->save($directory . $filename);

                    $imagePath[] = $path; // append new image
                }
            }

            if ($request->type == GalleryTypeEnum::IMAGE->value) {
                $gallery->update([
                    'value' => $imagePath,
                ]);
            } else {
                // remove existing images if switching to video
                $existingFilePath = public_path('uploads/gallery/' . $gallery->id . '/images/');
                if (File::exists($existingFilePath)) {
                    File::deleteDirectory($existingFilePath);
                }

                $gallery->update([
                    'value' => $request->type == GalleryTypeEnum::VIDEO->value ? $request->video_link : $gallery->value,
                ]);
            }

            DB::commit();
            Session::flash('success', 'Gallery updated successfully.');
            return redirect()->route('gallery.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function deleteImage(Gallery $gallery, $imageIndex)
    {
        DB::beginTransaction();
        try {
            $images = json_decode($gallery->value, true);
            // Remove the selected image based on its index
            if (isset($images[$imageIndex])) {
                $imagePath = $images[$imageIndex];
                unset($images[$imageIndex]);

                $images = count($images) == 0 ? null : $images;

                // Delete the image from storage
                File::delete($imagePath);

                // Update the gallery with the remaining images
                $gallery->update([
                    'value' => $images == null ? null : json_encode($images),
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/gallery/' . $gallery->id);
            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $gallery->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
