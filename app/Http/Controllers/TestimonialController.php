<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enum\PerspectiveFromEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\TestimonialRequest;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class TestimonialController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.testimonial.index');
    }

    public function testimonialData()
    {
        $datas = Testimonial::orderByIdDesc()->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perspectiveType = PerspectiveFromEnum::cases();
        array_shift($perspectiveType);

        return view('backend.testimonial.create', compact('perspectiveType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialRequest $request)
    {
        DB::beginTransaction();
        try {
            $testimonial = Testimonial::create([
                'full_name' => $request->full_name,
                'testimonial_text' => $request->testimonial_text,
                'testimonial_video' => $request->testimonial_video,
                'perspective_from' => $request->perspective_from,
                'is_featured' => $request->is_featured,
            ]);

            $imagePath = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/testimonial/' . $testimonial->id . '/' . $filename;

                $directory = public_path('uploads/testimonial/' . $testimonial->id . '/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)
                    ->save($directory . $filename);
            }

            $testimonial->update([
                'image' => $imagePath,
            ]);

            DB::commit();

            Session::flash('success', 'Testimonial created successfully.');

            return redirect()->route('testimonial.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        $perspectiveType = PerspectiveFromEnum::cases();
        array_shift($perspectiveType);

        return view('backend.testimonial.edit', compact('testimonial', 'perspectiveType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        DB::beginTransaction();
        try {
            $testimonial->update([
                'full_name' => $request->full_name,
                'testimonial_text' => $request->testimonial_text,
                'testimonial_video' => $request->testimonial_video,
                'perspective_from' => $request->perspective_from,
                'is_featured' => $request->is_featured,
            ]);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                    unlink(public_path($testimonial->image));
                }


                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/testimonial/' . $testimonial->id . '/' . $filename;

                $directory = public_path('uploads/testimonial/' . $testimonial->id . '/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)
                    ->save($directory . $filename);

                $testimonial->update([
                    'image' => $imagePath,
                ]);
            }

            DB::commit();

            Session::flash('success', 'Testimonial updated successfully.');

            return redirect()->route('testimonial.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        DB::beginTransaction();
        try {
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                unlink(public_path($testimonial->image));
            }

            $testimonial->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
