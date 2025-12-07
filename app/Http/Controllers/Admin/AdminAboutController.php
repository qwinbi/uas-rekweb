<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAboutController extends Controller
{
    public function index()
    {
        $aboutImage = Setting::getValue('about_image');
        $aboutDescription = Setting::getValue('about_description');
        
        return view('admin.settings.about', compact('aboutImage', 'aboutDescription'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about_image' => 'nullable|image|max:2048',
            'about_description' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('about_image')) {
            $aboutImagePath = $request->file('about_image')->store('about', 'public');
            $aboutImagePath = basename($aboutImagePath);
            Setting::setValue('about_image', $aboutImagePath);
        }

        if ($request->filled('about_description')) {
            Setting::setValue('about_description', $request->about_description);
        }

        return back()->with('success', 'About page updated successfully');
    }
}