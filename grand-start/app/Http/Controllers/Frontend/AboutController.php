<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $isIraq = $request->get('visitor_country') === 'IQ';

        $stats = [
            'projects' => Project::active()->count(),
            'years' => Setting::get('company_years', '10'),
            'clients' => Setting::get('total_clients', '500'),
            'countries' => Setting::get('countries_count', '5'),
        ];

        $whatsapp = $isIraq
            ? Setting::get('whatsapp_iraq', env('WHATSAPP_IRAQ'))
            : Setting::get('whatsapp_default', env('WHATSAPP_DEFAULT'));

        return view('frontend.about', compact('stats', 'isIraq', 'whatsapp'));
    }
}
