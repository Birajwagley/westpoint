<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Spatie\Permission\Guard;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('id', 'DESC')->get();

        return view('backend.role.index', compact('roles'));
    }

    public function roleData()
    {
        $roles = Auth::user()->hasRole('superadmin') ? Role::with('permissions')->get() : Role::with('permissions')->where('id', '!=', 1)->get();

        $data = $roles->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions->pluck('name')->toArray(),
            ];
        });

        return response()->json(['datas' => $data]);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('backend.role.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => Guard::getDefaultName(static::class),
            ]);

            $role->permissions()->attach($request->permissions);

            DB::commit();

            Session::flash('success', 'Role created successfuly.');

            return redirect()->route('role.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('backend.role.edit', compact('permissions', 'role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        DB::beginTransaction();
        try {
            $role->update([
                'name' => $request->name,
                'guard_name' => Guard::getDefaultName(static::class),
            ]);

            $role->permissions()->sync($request->permissions);

            DB::commit();

            Session::flash('success', 'Role updated successfuly.');

            return redirect()->route('role.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(Role $role)
    {
        DB::beginTransaction();
        try {
            $role->permissions()->detach();
            $role->delete();

            DB::commit();
            return response()->json(true);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(false);
        }
    }
}
