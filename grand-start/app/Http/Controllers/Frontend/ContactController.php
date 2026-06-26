<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $isIraq = $request->get('visitor_country') === 'IQ';

        $whatsapp = $isIraq
            ? Setting::get('whatsapp_iraq', env('WHATSAPP_IRAQ'))
            : Setting::get('whatsapp_default', env('WHATSAPP_DEFAULT'));

        $phone = $isIraq
            ? Setting::get('phone_iraq', Setting::get('phone_default'))
            : Setting::get('phone_default');

        $address = $isIraq
            ? Setting::get('address_iraq_' . app()->getLocale(), Setting::get('address_iraq_ar'))
            : Setting::get('address_default_' . app()->getLocale(), Setting::get('address_default_ar'));

        $email = $isIraq
            ? Setting::get('email_iraq', Setting::get('email_default'))
            : Setting::get('email_default');

        return view('frontend.contact', compact(
            'isIraq', 'whatsapp', 'phone', 'address', 'email'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:50',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'],
            'message' => $validated['message'],
            'country_code' => $request->get('visitor_country', 'AE'),
            'source' => 'contact_form',
        ]);

        return back()->with('success', __('app.message_sent'));
    }
}
