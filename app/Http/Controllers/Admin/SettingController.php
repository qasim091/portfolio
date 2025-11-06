<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::orderBy('key')->paginate(20);
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'nullable|string',
            'type' => 'required|in:text,email,phone,textarea,url,number,image,json',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        // Make image required if type is image
        if ($request->type === 'image') {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048';
        }

        // Make json_data required if type is json
        if ($request->type === 'json') {
            $rules['json_data'] = 'required|array|min:1';
            $rules['json_data.*'] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Handle JSON type
        if ($request->type === 'json' && $request->has('json_data')) {
            $validated['value'] = json_encode(array_values(array_filter($request->json_data)));
        }

        // Handle image upload
        if ($request->hasFile('image') && $request->type === 'image') {
            $image = $request->file('image');

            try {
                // Get file extension
                $extension = $image->getClientOriginalExtension() ?: $image->extension() ?: 'jpg';

                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $extension;

                // Define storage path
                $storagePath = storage_path('app/public/settings');

                // Create directory if it doesn't exist
                if (!file_exists($storagePath)) {
                    mkdir($storagePath, 0755, true);
                }

                // Move the uploaded file
                $image->move($storagePath, $filename);

                // Set the value to the public path
                $validated['value'] = '/storage/settings/' . $filename;

            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Upload error: ' . $e->getMessage()])->withInput();
            }
        }

        Setting::create([
            'key' => $validated['key'],
            'value' => $validated['value'] ?? null,
            'type' => $validated['type'],
        ]);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        return view('admin.settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $rules = [
            'key' => 'required|string|max:255|unique:settings,key,' . $setting->id,
            'value' => 'nullable|string',
            'type' => 'required|in:text,email,phone,textarea,url,number,image,json',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        // Make json_data required if type is json
        if ($request->type === 'json') {
            $rules['json_data'] = 'required|array|min:1';
            $rules['json_data.*'] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Handle JSON type
        if ($request->type === 'json' && $request->has('json_data')) {
            $validated['value'] = json_encode(array_values(array_filter($request->json_data)));
        }

        // Handle image upload
        if ($request->hasFile('image') && $request->type === 'image') {
            try {
                // Delete old image if exists
                if ($setting->value && file_exists(public_path($setting->value))) {
                    unlink(public_path($setting->value));
                }

                $image = $request->file('image');

                // Get file extension
                $extension = $image->getClientOriginalExtension() ?: $image->extension() ?: 'jpg';

                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $extension;

                // Define storage path
                $storagePath = storage_path('app/public/settings');

                // Create directory if it doesn't exist
                if (!file_exists($storagePath)) {
                    mkdir($storagePath, 0755, true);
                }

                // Move the uploaded file
                $image->move($storagePath, $filename);

                // Set the value to the public path
                $validated['value'] = '/storage/settings/' . $filename;

            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Upload error: ' . $e->getMessage()])->withInput();
            }
        } elseif ($request->type === 'image' && !$request->hasFile('image')) {
            // If type is image but no new image uploaded, preserve existing value
            unset($validated['value']); // Don't update the value field
        }

        $setting->update($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        // dd('');
        // Delete image file if it's an image type
        if ($setting->type === 'image' && $setting->value && file_exists(public_path($setting->value))) {
            unlink(public_path($setting->value));
        }

        $setting->delete();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully!');
    }
}
