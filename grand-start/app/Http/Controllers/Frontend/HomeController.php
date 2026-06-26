<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Setting;
use App\Services\CountryContactService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $countryCode = $request->get('visitor_country', 'AE');
        $contact = CountryContactService::getContact($countryCode);

        $featuredProjects = Project::active()->featured()
            ->with('images')
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $latestProjects = Project::active()
            ->with('images')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $stats = [
            'projects' => Project::active()->count(),
            'years' => Setting::get('company_years', '10'),
            'clients' => Setting::get('total_clients', '500'),
            'countries' => Setting::get('countries_count', '5'),
        ];

        $whatsapp = $contact['whatsapp'];

        return view('frontend.home', compact(
            'featuredProjects',
            'latestProjects',
            'stats',
            'countryCode',
            'whatsapp'
        ));
    }
}
