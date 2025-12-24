<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;

class SliderController extends BaseController
{
    public function index()
    {
        return view('backend.slider.index');
    }

    public function sliderData()
    {
        $datas = Slider::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Slider::orderBy('display_order', 'desc')->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        return view('backend.slider.create', compact('displayOrder'));
    }

    public function store(SliderRequest $request)
    {
        DB::beginTransaction();

        try {

            $slider = Slider::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);


            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();

                $directory = public_path('uploads/slider/' . $slider->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }


                $image->move($directory, $filename);


                $slider->update([
                    'image' => 'uploads/slider/' . $slider->id . '/images/' . $filename,
                ]);
            }

            DB::commit();

            Session::flash('success', 'Slider created successfully.');
            return redirect()->route('slider.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function edit(Slider $slider)
    {
        return view('backend.slider.edit', compact('slider'));
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        DB::beginTransaction();

        try {

            $slider->update([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);


            if ($request->hasFile('image')) {

                if ($slider->image && file_exists(public_path($slider->image))) {
                    unlink(public_path($slider->image));
                }

                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();

                $directory = public_path('uploads/slider/' . $slider->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }


                $image->move($directory, $filename);


                $slider->update([
                    'image' => 'uploads/slider/' . $slider->id . '/images/' . $filename,
                ]);
            }

            DB::commit();

            Session::flash('success', 'Slider updated successfully.');
            return redirect()->route('slider.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function destroy(Slider $slider)
    {
        DB::beginTransaction();
        try {
            $slider->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
