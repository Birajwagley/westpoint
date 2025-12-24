<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Teams;
use App\Enum\TeamEnum;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TeamsRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class TeamsController extends BaseController
{
    public function index()
    {
        return view('backend.teams.index');
    }

    public function teamData()
    {
        $datas = Teams::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }
    public function create()
    {
        $displayOrder = Teams::displayOrderDesc()->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        $types = TeamEnum::cases();
        $departments = Department::published()->get();
        $designations = Designation::published()->get();

        return view('backend.teams.create', compact('types', 'displayOrder', 'designations', 'departments'));
    }

    public function store(TeamsRequest $request)
    {
        DB::beginTransaction();
        try {
            $teams = Teams::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'department_id' => $request->department_id,
                'designation_id' => $request->designation_id,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'facebook' => $request->facebook,
                'linked_in' => $request->linked_in,
                'type' => $request->type,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
                'display_order' => $request->display_order,
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/teams/' . $teams->id . '/images/' . $filename;

                $directory = public_path('uploads/teams/' . $teams->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);
            }

            $teams->update([
                'image' => $imagePath,
            ]);

            DB::commit();

            Session::flash('success', 'Teams created successfully.');

            return redirect()->route('team.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
    public function edit(Teams $team)
    {
        $types = TeamEnum::cases();
        $departments = Department::published()->get();
        $designations = Designation::published()->get();

        return view('backend.teams.edit', compact('team', 'departments', 'types', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamsRequest $request, Teams $team)
    {
        DB::beginTransaction();
        try {
            $team->update([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'department_id' => $request->department_id,
                'designation_id' => $request->designation_id,
                'description_en' => $request->description_en,
                'description_np' => $request->description_np,
                'facebook' => $request->facebook,
                'linked_in' => $request->linked_in,
                'type' => $request->type,
                'is_published' => $request->is_published,
                'is_featured' => $request->is_featured,
                'display_order' => $request->display_order,
            ]);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($team->image && file_exists(public_path($team->image))) {
                    unlink(public_path($team->image));
                }

                $image = $request->file('image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/teams/' . $team->id . '/images/' . $filename;

                $directory = public_path('uploads/teams/' . $team->id . '/images/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager
                    ->read($image)
                    ->save($directory . $filename);

                $team->update([
                    'image' => $imagePath,
                ]);
            }
            DB::commit();
            Session::flash('success', 'Teams updated successfully.');
            return redirect()->route('team.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function destroy(Teams $team)
    {
        DB::beginTransaction();
        try {
            $filePath = public_path('uploads/teams/' . $team->id);

            if (File::exists($filePath)) {
                File::deleteDirectory($filePath);
            }
            $team->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(false);
        }
    }
}
