<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Setting;
use App\Models\ContactUs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Frontend\ContactUsRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function contact()
    {
        $setting = Setting::select('map', 'facebook', 'instagram', 'linkedin', 'x', 'youtube')->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(emails, '$[0]')) as email1")->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(emails, '$[1]')) as email2")->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(contacts, '$[0]')) as contact")->first();

        return view('frontend.contact-us', compact('setting'));
    }

    public function storeContact(ContactUsRequest $request)
    {
        DB::beginTransaction();
        try {
            $contact = ContactUs::create([
                'full_name' => $request->full_name,
                'contact_no' => $request->contact_no,
                'email' => $request->email,
                'message' => $request->message,
            ]);

            $contact_admin = env('MAIL_FROM_ADDRESS');
            Mail::to($contact_admin)->send(new ContactMail($contact));

            DB::commit();

            Session::flash('success', __('pages.thankyou_for_contacting'));

            return redirect()->route('contact');
        } catch (Exception $e) {
            DB::rollBack();

            Session::flash('error', 'Sorry, there was some issue. Please try again!!');

            return redirect()->back();
        }
    }
}
