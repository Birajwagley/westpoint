<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\ContactUs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Backend\BaseController;

class ContactUsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.contact-us.index');
    }

    public function contactUsData()
    {
        $datas = ContactUs::orderByIdDesc()->get();

        return response()->json([
            'datas' => $datas,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactUs $contactCrud)
    {
        $contactUs = $contactCrud;
        return view('backend.contact-us.show', compact('contactUs'));
    }

    public function update(ContactUsRequest $request, ContactUs $contactCrud)
    {
        DB::beginTransaction();

        try {
            $contactCrud->update([
                'is_contacted' => $request->is_contacted,
                'contact_remarks' => $request->contact_remarks,
                'is_published' => Auth::user()->id,
            ]);

            DB::commit();

            Session::flash('success', 'Contact Us updated successfully.');

            return redirect()->route('contact-us.index');
        } catch (Exception $e) {
            DB::rollback();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}
