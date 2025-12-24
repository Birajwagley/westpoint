<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StatisticsRequest;
use App\Http\Controllers\Backend\BaseController;

class StatisticsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.statistics.index');
    }

    public function statisticsData()
    {
        $datas = Statistic::orderBy('display_order')->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $displayOrder = Statistic::orderBy('display_order', 'desc')->pluck('display_order')->first();
        $displayOrder = $displayOrder == null ? 1 : $displayOrder + 1;


        return view('backend.statistics.create', compact('displayOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatisticsRequest $request)
    {
        DB::beginTransaction();

        try {
            Statistic::create([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'count' => $request->count,
                'icon' => $request->icon,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Statistics created successfully.');
            return redirect()->route('statistic.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Statistic $statistic)
    {
        return view('backend.statistics.edit', compact('statistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Statistic $statistic)
    {
        DB::beginTransaction();

        try {
            $statistic->update([
                'name_en' => $request->name_en,
                'name_np' => $request->name_np,
                'count' => $request->count,
                'icon' => $request->icon,
                'display_order' => $request->display_order,
                'is_published' => $request->is_published,
            ]);

            DB::commit();

            Session::flash('success', 'Statistics updated successfully.');

            return redirect()->route('statistic.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statistic $statistic)
    {
        DB::beginTransaction();
        try {
            $statistic->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }
}
