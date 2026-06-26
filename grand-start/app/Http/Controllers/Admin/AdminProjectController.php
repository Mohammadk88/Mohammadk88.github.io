<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('images');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $projects = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateProject($request);

        $project = new Project($validated);

        if ($request->hasFile('main_image')) {
            $project->main_image = $this->uploadImage($request->file('main_image'), 'projects');
        }

        $project->slug = Str::slug($request->title_en ?: $request->title_ar) . '-' . Str::random(6);
        $project->save();

        $this->saveFeatures($project, $request->features ?? []);

        return redirect()->route('admin.projects.index')
            ->with('success', 'تم إضافة المشروع بنجاح');
    }

    public function show(Project $project)
    {
        $project->load(['images', 'features', 'contacts']);
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $project->load(['images', 'features']);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $this->validateProject($request);

        if ($request->hasFile('main_image')) {
            if ($project->main_image) {
                Storage::delete('public/' . $project->main_image);
            }
            $validated['main_image'] = $this->uploadImage($request->file('main_image'), 'projects');
        }

        $project->update($validated);

        $this->saveFeatures($project, $request->features ?? []);

        return redirect()->route('admin.projects.index')
            ->with('success', 'تم تحديث المشروع بنجاح');
    }

    public function destroy(Project $project)
    {
        if ($project->main_image) {
            Storage::delete('public/' . $project->main_image);
        }

        foreach ($project->images as $image) {
            Storage::delete('public/' . $image->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'تم حذف المشروع بنجاح');
    }

    public function uploadImages(Request $request, Project $project)
    {
        $request->validate([
            'images.*' => 'required|image|max:5120',
        ]);

        $uploaded = 0;
        foreach ($request->file('images', []) as $file) {
            $path = $this->uploadImage($file, 'projects/gallery');
            ProjectImage::create([
                'project_id' => $project->id,
                'image' => $path,
                'sort_order' => $project->images()->count() + 1,
            ]);
            $uploaded++;
        }

        return response()->json(['success' => true, 'uploaded' => $uploaded]);
    }

    public function deleteImage(Project $project, ProjectImage $image)
    {
        Storage::delete('public/' . $image->image);
        $image->delete();

        return response()->json(['success' => true]);
    }

    public function toggleFeatured(Project $project)
    {
        $project->update(['featured' => !$project->featured]);

        return response()->json([
            'success' => true,
            'featured' => $project->featured,
        ]);
    }

    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'title_ku' => 'nullable|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ku' => 'nullable|string',
            'location_ar' => 'required|string|max:255',
            'location_en' => 'nullable|string|max:255',
            'location_ku' => 'nullable|string|max:255',
            'price_usd' => 'nullable|numeric|min:0',
            'price_iqd' => 'nullable|numeric|min:0',
            'area' => 'nullable|string|max:100',
            'floors' => 'nullable|integer|min:1',
            'units' => 'nullable|integer|min:1',
            'status' => 'required|in:available,sold_out,under_construction,coming_soon',
            'type' => 'required|in:residential,commercial,villa,apartment,compound,tower',
            'featured' => 'boolean',
            'active' => 'boolean',
            'video_url' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'delivery_date' => 'nullable|date',
            'sort_order' => 'nullable|integer',
        ]);
    }

    private function uploadImage($file, string $folder): string
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->storeAs("public/{$folder}", $filename);
        return "{$folder}/{$filename}";
    }

    private function saveFeatures(Project $project, array $features): void
    {
        $project->features()->delete();

        foreach ($features as $feature) {
            if (!empty($feature['ar']) || !empty($feature['en'])) {
                ProjectFeature::create([
                    'project_id' => $project->id,
                    'feature_ar' => $feature['ar'] ?? null,
                    'feature_en' => $feature['en'] ?? null,
                    'feature_ku' => $feature['ku'] ?? null,
                    'icon' => $feature['icon'] ?? 'fas fa-check',
                ]);
            }
        }
    }
}
