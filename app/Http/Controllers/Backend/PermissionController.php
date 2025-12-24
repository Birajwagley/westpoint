<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('backend.permission.index');
    }

    public function permissionData()
    {
        $datas = Permission::all();

        return response()->json([
            'datas' => $datas,
        ]);
    }
}
