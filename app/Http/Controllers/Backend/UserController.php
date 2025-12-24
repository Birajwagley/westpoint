<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Backend\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return view('backend.user.index');
    }

    public function userData()
    {
        $datas = Auth::user()->hasRole('superadmin') ?
            User::with('roles')->orderBy('id', 'DESC')->get() :
            User::where('id', '!=', 1)->with('roles')->orderBy('id', 'DESC')->get();

        return response()->json(['datas' => $datas]);
    }

    public function create()
    {
        $roles = Auth::user()->hasRole('superadmin') ? Role::all() : Role::where('id', '!=', 1)->get();

        return view('backend.user.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active,
            ]);

            if ($request->hasFile('thumbnail_image')) {
                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/thumbnails/' . $user->id . '/' . $filename;

                $directory = public_path('uploads/thumbnails/' . $user->id . '/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)
                    ->save($directory . $filename);
            }

            $user->update([
                'thumbnail_image' => $path,
            ]);

            $user->assignRole(Role::find($request->role_id));

            DB::commit();
            Session::flash('success', 'User created successfully.');
            return redirect()->route('user.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Auth::user()->hasRole('superadmin') ? Role::all() : Role::where('id', '!=', 1)->get();

        return view('backend.user.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $data = [
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'is_active' => $request->is_active,
            ];

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('thumbnail_image')) {
                // Delete old image
                if ($user->thumbnail_image && file_exists(public_path($user->thumbnail_image))) {
                    unlink(public_path($user->thumbnail_image));
                }

                $image = $request->file('thumbnail_image');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/thumbnails/' . $user->id . '/' . $filename;

                $directory = public_path('uploads/thumbnails/' . $user->id . '/');
                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                // Save resized image using Intervention v3
                $manager = new ImageManager(new Driver());
                $manager->read($image)
                    ->save($directory . $filename);

                $data['thumbnail_image'] = $path;
            }

            $user->update($data);

            $user->syncRoles([Role::find($request->role_id)]);

            DB::commit();
            Session::flash('success', 'User updated successfully.');
            return redirect()->route('user.index');
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Sorry, there was some issue. Please try again!!');
            return redirect()->back();
        }
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            if ($user->thumbnail_image && file_exists(public_path($user->thumbnail_image))) {
                unlink(public_path($user->thumbnail_image));
            }

            $user->delete();
            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }
}
