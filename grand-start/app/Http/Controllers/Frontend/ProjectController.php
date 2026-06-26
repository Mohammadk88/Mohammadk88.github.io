<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $isIraq = $request->get('visitor_country') === 'IQ';

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
                  ->orWhere('location_ar', 'like', "%{$search}%")
                  ->orWhere('location_en', 'like', "%{$search}%");
            });
        }

        $projects = $query->orderBy('featured', 'desc')
                         ->orderBy('sort_order')
                         ->orderBy('created_at', 'desc')
                         ->paginate(9);

        $whatsapp = $isIraq
            ? Setting::get('whatsapp_iraq', env('WHATSAPP_IRAQ'))
            : Setting::get('whatsapp_default', env('WHATSAPP_DEFAULT'));

        return view('frontend.projects.index', compact('projects', 'isIraq', 'whatsapp'));
    }

    public function show(Request $request, string $slug)
    {
        $project = Project::where('slug', $slug)->active()->with(['images', 'features'])->firstOrFail();
        $isIraq = $request->get('visitor_country') === 'IQ';

        $relatedProjects = Project::active()
            ->where('id', '!=', $project->id)
            ->where('type', $project->type)
            ->with('images')
            ->take(3)
            ->get();

        $whatsapp = $isIraq
            ? Setting::get('whatsapp_iraq', env('WHATSAPP_IRAQ'))
            : Setting::get('whatsapp_default', env('WHATSAPP_DEFAULT'));

        $phone = $isIraq
            ? Setting::get('phone_iraq', Setting::get('phone_default'))
            : Setting::get('phone_default');

        return view('frontend.projects.show', compact(
            'project',
            'relatedProjects',
            'isIraq',
            'whatsapp',
            'phone'
        ));
    }
}
