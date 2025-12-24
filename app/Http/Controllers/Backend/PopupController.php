<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Popup;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PopupRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class PopupController extends BaseController
{
    public function index()
    {
        return view('backend.popup.index');
    }

    public function popupData()
    {
        $datas = Popup::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $displayOrder = Popup::orderBy('display_order', 'desc')->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        return view('backend.popup.create', compact('displayOrder'));
    }

    public function store(PopupRequest $request)
    {
        DB::beginTransaction();

        try {
            $popup = Popup::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'publish_date' => $request->publish_date,
                'publish_upto' => $request->publish_upto,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            $imagePath = [];
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/popup/' . $popup->id . '/images/' . $filename;

                $directory = public_path('uploads/popup/' . $popup->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)->save($directory . $filename);
            }

            $popup->update([
                'image' => $imagePath,
            ]);

            DB::commit();

            Session::flash('success', 'Popup created successfully.');
            return redirect()->route('popup.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Popup $popup)
    {
        return view('backend.popup.edit', compact('popup'));
    }

    public function update(PopupRequest $request, Popup $popup)
    {
        DB::beginTransaction();

        try {
            $popup->update([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'publish_date' => $request->publish_date,
                'publish_upto' => $request->publish_upto,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($popup->image && file_exists(public_path($popup->image))) {
                    unlink(public_path($popup->image));
                }

                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/popup/' . $popup->id . '/images/' . $filename;

                $directory = public_path('uploads/popup/' . $popup->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);

                $popup->update([
                    'image' => $imagePath,
                ]);
            }

            DB::commit();

            Session::flash('success', 'Popup updated successfully.');

            return redirect()->route('popup.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(Popup $popup)
    {
        DB::beginTransaction();
        try {
            $popup->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
