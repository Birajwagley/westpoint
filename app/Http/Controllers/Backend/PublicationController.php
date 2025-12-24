<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Publication;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\PublicationCategory;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PublicationRequest;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class PublicationController extends BaseController
{
    public function index()
    {
        return view('backend.publication.index');
    }

    public function publicationData()
    {
        $datas = Publication::with('publicationCategory')->orderBy('id', 'DESC')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $publicationCategories = PublicationCategory::published()->get();

        return view('backend.publication.create', compact('publicationCategories'));
    }

    public function store(PublicationRequest $request)
    {
        DB::beginTransaction();
        try {
            $publication = Publication::create([
                'publication_category_id' => $request->publication_category_id,
                'published_date' => $request->published_date,
                'author' => $request->author,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'slug' => $this->checkUnique($request, null, 'publications'),
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'external_link' => $request->external_link,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
            ]);

            $thumnailImagePath = null;
            if ($request->hasFile('thumbnail_image')) {
                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $thumnailImagePath = 'uploads/publication/' . $publication->id . '/thumbnails/' . $filename;

                $directory = public_path('uploads/publication/' . $publication->id . '/thumbnails/');
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
                    $imagePath[] = 'uploads/publication/' . $publication->id . '/images/' . $filename;

                    $directory = public_path('uploads/publication/' . $publication->id . '/images/');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0755, true);
                    }

                    // Save resized image using Intervention v3
                    $manager = new ImageManager(new Driver());
                    $manager->read($image)->save($directory . $filename);
                }
            }

            $publication->update([
                'thumbnail_image' => $thumnailImagePath,
                'images' => $imagePath,
            ]);

            DB::commit();

            Session::flash('success', 'Publication created successfully.');

            return redirect()->route('publication.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Publication $publication)
    {
        $publicationCategories = PublicationCategory::published()->get();

        return view('backend.publication.edit', compact('publication', 'publicationCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationRequest $request, Publication $publication)
    {
        DB::beginTransaction();
        try {
            $publication->update([
                'publication_category_id' => $request->publication_category_id,
                'published_date' => $request->published_date,
                'author' => $request->author,
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'slug' => $publication->slug == $request->slug ? $publication->slug : $this->checkUnique($request, $publication->id, 'publications'),
                'short_description_en' => $request->short_description_en,
                'short_description_np' => $request->short_description_np,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'external_link' => $request->external_link,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
            ]);

            if ($request->hasFile('thumbnail_image')) {
                // Delete old image
                if ($publication->thumbnail_image && file_exists(public_path($publication->thumbnail_image))) {
                    unlink(public_path($publication->thumbnail_image));
                }

                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $thumnailImagePath = 'uploads/publication/' . $publication->id . '/thumbnails/' . $filename;

                $directory = public_path('uploads/publication/' . $publication->id . '/thumbnails/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);

                $publication->update([
                    'thumbnail_image' => $thumnailImagePath,
                ]);
            }

            $imagePath = json_decode($publication->images, true) ?? [];

            if ($request->hasFile('images')) {
                $directory = public_path('uploads/publication/' . $publication->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                foreach ($request->file('images') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = 'uploads/publication/' . $publication->id . '/images/' . $filename;

                    // Save the file
                    File::put($path, file_get_contents($file));

                    // Save resized image using Intervention
                    $manager = new ImageManager(new Driver());
                    $manager->read($file)->save($directory . $filename);

                    $imagePath[] = $path; // append new image
                }
            }

            $publication->update([
                'images' => $imagePath,
            ]);

            DB::commit();
            Session::flash('success', 'Publication updated successfully.');
            return redirect()->route('publication.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function deleteImage(Publication $publication, $imageIndex)
    {
        DB::beginTransaction();
        try {
            $images = json_decode($publication->images, true);
            // Remove the selected image based on its index
            if (isset($images[$imageIndex])) {
                $imagePath = $images[$imageIndex];
                unset($images[$imageIndex]);

                // Delete the image from storage
                File::delete($imagePath);

                // Update the gallery with the remaining images
                $publication->update([
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

    public function destroy(Publication $publication)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/publication/' . $publication->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }

            $publication->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
