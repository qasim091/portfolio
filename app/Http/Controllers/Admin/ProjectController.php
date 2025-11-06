<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.projects.manage', compact('projects'));
    }

    public function create()
    {
        $categories = Category::orderBy('order')->orderBy('name')->get();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'description' => 'required|string',
            'long_description' => 'required|string',
            'tech' => 'required|array',
            'images' => 'required|array',
            'github' => 'nullable|url',
            'live' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'features' => 'nullable|array',
            'challenges' => 'nullable|string',
            'outcome' => 'nullable|string',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        $project->load('category');
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $categories = Category::orderBy('order')->orderBy('name')->get();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug,' . $project->id,
            'description' => 'required|string',
            'long_description' => 'required|string',
            'tech' => 'required|array',
            'images' => 'required|array',
            'github' => 'nullable|url',
            'live' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'features' => 'nullable|array',
            'challenges' => 'nullable|string',
            'outcome' => 'nullable|string',
            'is_featured' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
