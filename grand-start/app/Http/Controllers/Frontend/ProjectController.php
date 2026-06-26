<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\CountryContactService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $countryCode = $request->get('visitor_country', 'AE');
        $contact = CountryContactService::getContact($countryCode);

        $query = Project::active()->with('images');

        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%")
                  ->orWhere('title_tr', 'like', "%{$search}%")
                  ->orWhere('location_ar', 'like', "%{$search}%")
                  ->orWhere('location_en', 'like', "%{$search}%");
            });
        }

        $projects = $query->orderBy('featured', 'desc')
                         ->orderBy('sort_order')
                         ->orderBy('created_at', 'desc')
                         ->paginate(9);

        $whatsapp = $contact['whatsapp'];

        return view('frontend.projects.index', compact('projects', 'countryCode', 'whatsapp'));
    }

    public function show(Request $request, string $slug)
    {
        $project = Project::where('slug', $slug)->active()->with(['images', 'features'])->firstOrFail();
        $countryCode = $request->get('visitor_country', 'AE');
        $contact = CountryContactService::getContact($countryCode);

        $relatedProjects = Project::active()
            ->where('id', '!=', $project->id)
            ->where('type', $project->type)
            ->with('images')
            ->take(3)
            ->get();

        $whatsapp = $contact['whatsapp'];
        $phone = $contact['phone'];

        return view('frontend.projects.show', compact(
            'project',
            'relatedProjects',
            'countryCode',
            'whatsapp',
            'phone'
        ));
    }
}
