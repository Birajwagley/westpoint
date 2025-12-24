<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        return view('backend.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        DB::beginTransaction();

        try {
            $data = [
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'is_active' => true,
            ];

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail_image')) {
                // Delete old thumbnail if exists
                if ($user->thumbnail_image && file_exists(public_path($user->thumbnail_image))) {
                    unlink(public_path($user->thumbnail_image));
                }

                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $thumbnailPath = public_path('uploads/thumbnails/' . $filename);

                // Ensure the upload directory exists
                $uploadDir = public_path('uploads/thumbnails');
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // Resize and save using Intervention Image
                $manager = new ImageManager(new Driver());
                $manager->read($image)
                    ->save($thumbnailPath);

                // Save thumbnail path in database
                $data['thumbnail_image'] = 'uploads/thumbnails/' . $filename;
            }

            $user->update($data);

            DB::commit();
            Session::flash('success', 'User profile updated successfully.');
            return redirect()->route('profile.edit');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was an issue. Please try again!');
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
