<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Get web settings as an array
     */
    protected function getWebSettings()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        // Get image and ensure it has proper URL
        $image = $settings['image'] ?? '/img/qasim.jpg';
        // If image starts with / (local path), use asset() helper
        if (str_starts_with($image, '/')) {
            $image = asset($image);
        }

        return (object) [
            'site_name' => $settings['site_name'] ?? 'My Portfolio',
            'name' => $settings['name'] ?? 'Qaime Mehmood',
            'image' => $image,
            'site_tagline' => $settings['site_tagline'] ?? 'Full Stack Developer',
            'contact_email' => $settings['contact_email'] ?? 'Qasimmehmood1413@gmail.com',
            'whatsapp' => $settings['whatsapp'] ?? '0315-7750480',
            'contact_address' => $settings['contact_address'] ?? 'Abbottabad, Pakistan',
            'github_url' => $settings['github_url'] ?? 'https://github.com/qasim091',
            'linkedin_url' => $settings['linkedin_url'] ?? 'https://www.linkedin.com/in/qasimcoder/',
        ];
    }

    public function index()
    {
        // $webSettings = $this->getWebSettings();
        // Uncomment to debug: dd($webSettings);

        // Get featured projects for the home page
        $projects = Project::with('category')
            ->featured()
            ->orderBy('order')
            ->take(6)
            ->get();

        // Get web settings (also available globally via SettingsServiceProvider)
        // $webSettings = $this->getWebSettings();
        $webSettings = (object) DB::table('settings')->pluck('value', 'key')->toArray();
        // Decode JSON field for skills
        $webSettings->skills = json_decode($webSettings->skills, true);
        return view('home', compact('projects', 'webSettings'));
    }
    public function project(Request $request)
    {
        // dd('');
        $search = $request->input('search');
        $category = $request->input('category', 'All');

        $projects = Project::with('category')
            ->search($search)
            ->byCategory($category)
            ->orderBy('order')
            ->paginate(12);

        $categories = Category::orderBy('order')->orderBy('name')->get();

        // Get web settings
        $webSettings = $this->getWebSettings();

        return view('projects.index', compact('projects', 'categories', 'search', 'category', 'webSettings'));
    }

    public function projectshow($slug)
    {
        $project = Project::with('category')->where('slug', $slug)->firstOrFail();

        // Get related projects from the same category
        $relatedProjects = Project::with('category')
            ->where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->orderBy('order')
            ->take(3)
            ->get();

        // Get web settings
        $webSettings = $this->getWebSettings();

        return view('projects.show', compact('project', 'relatedProjects', 'webSettings'));
    }
}
