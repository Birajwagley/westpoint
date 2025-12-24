<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\GroupRequest;
use App\Http\Controllers\Backend\BaseController;

class GroupController extends BaseController
{
    public function index()
    {
        return view('backend.group.index');
    }

    public function groupData()
    {
        $datas = Group::all()->each->setAppends([]);

        return response()->json(['datas' => $datas]);
    }

    public function create()
    {
        $displayOrder = Group::pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;

        return view('backend.group.create', compact('displayOrder'));
    }

    public function store(GroupRequest $request)
    {
        DB::beginTransaction();
        try {
            Group::create([
                'name' => $request->name,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'have_multi_subject' => $request->have_multi_subject,
            ]);

            DB::commit();

            Session::flash('success', 'Group created successfully.');

            return redirect()->route('group.index');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
    public function edit(Group $group)
    {
        return view('backend.group.edit', compact('group'));
    }

    public function update(GroupRequest $request, Group $group)
    {
        DB::beginTransaction();

        try {
            $details = [
                'name' => $request->name,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
                'have_multi_subject' => $request->have_multi_subject,
            ];

            $group->update($details);

            DB::commit();

            Session::flash('success', 'Group updated successfully.');

            return redirect()->route('group.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    public function destroy(Group $group)
    {
        DB::beginTransaction();
        try {
            $group->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
