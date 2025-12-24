<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\SubscriptionExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Controllers\Backend\BaseController;

class SubscriptionController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.subscription.index');
    }

    public function subscriptionData()
    {
        return response()->json([
            'datas' => Subscription::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {
        DB::beginTransaction();

        try {
            Subscription::create([
                'email' => $request->email,
                'is_active' => $request->is_active,
            ]);

            DB::commit();

            Session::flash('success', 'Subscription created successfully.');
            return redirect()->route('subscription.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        return view('backend.subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        DB::beginTransaction();

        try {
            $subscription->update([
                'email' => $request->email,
                'is_active' => $request->is_active,
            ]);

            DB::commit();

            Session::flash('success', 'Subscription updated successfully.');

            return redirect()->route('subscription.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        DB::beginTransaction();
        try {
            $subscription->delete();

            DB::commit();

            return response()->json(true);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(false);
        }
    }

    public function excelExport(Request $request)
    {
        try {
            $data = DB::table('subscriptions')
                ->where('is_active', $request->is_active)
                ->select([
                    DB::raw('ROW_NUMBER() OVER (ORDER BY id DESC) AS s_n'),
                    'email',
                ])
                ->get();

            $export = new SubscriptionExport($data);
            $name = 'EmailSubscription.xlsx';

            Session::flash('success', 'Excel exported for Subscription successfully.');

            return Excel::download($export, $name);
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}
