<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_categories' => Category::count(),
            'total_projects' => Project::count(),
            'featured_projects' => Project::where('is_featured', true)->count(),

        ];

        $recentProjects = Project::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentProjects' ));
    }
}
