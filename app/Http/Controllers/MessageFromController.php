<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Department;
use App\Models\Designation;
use App\Models\MessageFrom;
use Illuminate\Support\Str;
use App\Enum\MessageFromTypeEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\MessageFromRequest;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class MessageFromController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = MessageFrom::all();

        return view('backend.message-from.index', compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MessageFrom $messageFrom)
    {
        $countries = countries();
        $designations = Designation::published()->get();
        $departments = Department::published()->get();

        return view('backend.message-from.edit', compact('messageFrom', 'designations', 'countries', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MessageFromRequest $request, MessageFrom $messageFrom)
    {
        DB::beginTransaction();
        try {
            if ($request->slug == MessageFromTypeEnum::INDIRAYAKTHUMBA->value) {
                $details = [
                    'name' => $request->name,
                    'designation_id' => $request->designation_id,
                    'department_id' => $request->department_id,
                    'date_of_birth' => $request->date_of_birth,
                    'correspondaence_address' => $request->correspondaence_address,
                    'permanent_address' => $request->permanent_address,
                    'country_visited' => $request->country_visited,
                    'external_link' => $request->external_link,
                    'educational_qualification' => $request->educational_qualification,
                    'awards' => $request->awards,
                    'seminar' => $request->seminar,
                    'experience' => $request->experience,
                    'description' => $request->description,
                ];
            } else {
                $details = [
                    'name' => $request->name,
                    'external_link' => $request->external_link,
                    'description' => $request->description,
                ];
            }

            if ($request->type == 'en') {
                $imagePath = $messageFrom->image;
                if ($request->hasFile('image')) {
                    // Delete old image
                    if ($messageFrom->image && file_exists(public_path($messageFrom->image))) {
                        unlink(public_path($messageFrom->image));
                    }

                    $image = $request->file('image');
                    $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = 'uploads/messageFrom/' . $messageFrom->id . '/images/' . $filename;

                    $directory = public_path('uploads/messageFrom/' . $messageFrom->id . '/images/');
                    if (!File::exists($directory)) {
                        File::makeDirectory($directory, 0755, true);
                    }

                    // Save resized image using Intervention v3
                    $manager = new ImageManager(new Driver());
                    $manager
                        ->read($image)
                        ->save($directory . $filename);
                }

                $messageFrom->update([
                    'image' => $imagePath,
                    'information_en' => json_encode($details),
                ]);
            } else {
                $messageFrom->update([
                    'information_np' => json_encode($details),
                ]);
            }

            DB::commit();

            Session::flash('success', 'Information updated successfully.');

            return redirect()->route('message-from.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}
