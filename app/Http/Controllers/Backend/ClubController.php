<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Club;
use App\Models\Menu;
use App\Enum\ClubEnum;
use App\Enum\LinkTypeEnum;
use Illuminate\Support\Str;
use App\Http\Requests\ClubRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class ClubController extends BaseController
{
    public function index()
    {
        return view('backend.club.index');
    }

    public function clubData()
    {
        $datas = Club::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Club::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $types = LinkTypeEnum::cases();
        $school_amenities = ClubEnum::cases();

        return view('backend.club.create', compact('displayOrder', 'types', 'school_amenities'));
    }

    public function store(ClubRequest $request)
    {
        DB::beginTransaction();
        try {
            $beyondAcademic = Club::create([
                'slug' => $this->checkUnique($request, null, 'clubs'),
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'icon' => $request->icon,
                'school_amenity' => $request->school_amenity,
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
                $thumnailImagePath = 'uploads/club/' . $beyondAcademic->id . '/thumbnails/' . $filename;

                $directory = public_path('uploads/club/' . $beyondAcademic->id . '/thumbnails/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);
            }

            $imagePath = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $image = $file;
                    $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $imagePath[] = 'uploads/club/' . $beyondAcademic->id . '/images/' . $filename;

                    $directory = public_path('uploads/club/' . $beyondAcademic->id . '/images/');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0755, true);
                    }

                    // Save resized image using Intervention v3
                    $manager = new ImageManager(new Driver());
                    $manager->read($image)->save($directory . $filename);
                }
            }

            $beyondAcademic->update([
                'thumbnail_image' => $thumnailImagePath,
                'images' => $imagePath,
            ]);

            DB::commit();

            Session::flash('success', 'Beyond Academic created successfully.');

            return redirect()->route('beyond-academic.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Club $beyondAcademic)
    {
        $club = $beyondAcademic;
        $types = LinkTypeEnum::cases();
        $school_amenities = ClubEnum::cases();

        return view('backend.club.edit', compact('club', 'types', 'school_amenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClubRequest $request, Club $beyondAcademic)
    {
        DB::beginTransaction();
        try {
            $beyondAcademic->update([
                'slug' => $beyondAcademic->slug == $request->slug ? $beyondAcademic->slug : $this->checkUnique($request, $beyondAcademic->id, 'clubs'),
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'icon' => $request->icon,
                'school_amenity' => $request->school_amenity,
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
                if ($beyondAcademic->thumbnail_image && file_exists(public_path($beyondAcademic->thumbnail_image))) {
                    unlink(public_path($beyondAcademic->thumbnail_image));
                }

                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $thumnailImagePath = 'uploads/club/' . $beyondAcademic->id . '/thumbnails/' . $filename;

                $directory = public_path('uploads/club/' . $beyondAcademic->id . '/thumbnails/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);

                $beyondAcademic->update([
                    'thumbnail_image' => $thumnailImagePath,
                ]);
            }

            $imagePath = json_decode($beyondAcademic->images, true) ?? [];

            if ($request->hasFile('images')) {
                $directory = public_path('uploads/club/' . $beyondAcademic->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                foreach ($request->file('images') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = 'uploads/club/' . $beyondAcademic->id . '/images/' . $filename;

                    // Save the file
                    File::put($path, file_get_contents($file));

                    // Save resized image using Intervention
                    $manager = new ImageManager(new Driver());
                    $manager->read($file)->save($directory . $filename);

                    $imagePath[] = $path; // append new image
                }
            }

            $beyondAcademic->update([
                'images' => $imagePath,
            ]);

            DB::commit();
            Session::flash('success', 'Beyond Academic updated successfully.');
            return redirect()->route('beyond-academic.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function deleteImage(Club $beyondAcademic, $imageIndex)
    {
        DB::beginTransaction();
        try {
            $images = json_decode($beyondAcademic->images, true);
            // Remove the selected image based on its index
            if (isset($images[$imageIndex])) {
                $imagePath = $images[$imageIndex];
                unset($images[$imageIndex]);

                // Delete the image from storage
                File::delete($imagePath);

                // Update the gallery with the remaining images
                $beyondAcademic->update([
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

    public function destroy(Club $beyondAcademic)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/club/' . $beyondAcademic->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $beyondAcademic->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
