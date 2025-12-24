<?php

namespace App\Http\Controllers\Backend;

use App\Models as Models;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    public function updateIsActive($id, $model, Request $request)
    {
        $model = Models::class . '\\' . $model;

        DB::beginTransaction();
        try {
            $status = $model::whereId($id)->update([
                'is_active' => $request->is_active == 'true' ? 1 : 0,
            ]);

            DB::commit();

            return $status;
        } catch (\Exception $e) {
            DB::rollback();

            return $e;
        }
    }

    public function updateIsPublished($id, $model, Request $request)
    {
        $model = Models::class . '\\' . $model;

        DB::beginTransaction();
        try {
            $status = $model::whereId($id)->update([
                'is_published' => $request->is_published == 'true' ? 1 : 0,
            ]);

            DB::commit();

            return $status;
        } catch (\Exception $e) {
            DB::rollback();

            return $e;
        }
    }

    public function checkUnique($request, $id, $table)
    {
        $validator = Validator::make($request->all(), [
            'slug' => [
                'required',
                Rule::unique($table, 'slug')->ignore($id),
            ],
        ]);

        if (!$validator->fails()) {
            return $request->slug;
        } else {
            return $request->slug . '-' . rand(10, 99);
        }
    }
}
