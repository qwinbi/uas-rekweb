<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingController extends Controller
{
    public function logo()
    {
        $logo = Setting::getValue('logo');
        return view('admin.settings.logo', compact('logo'));
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|max:2048',
        ]);

        $logoPath = $request->file('logo')->store('logo', 'public');
        $logoPath = basename($logoPath);
        
        Setting::setValue('logo', $logoPath);

        return back()->with('success', 'Logo updated successfully');
    }

    public function footer()
    {
        $footerText = Setting::getValue('footer_text', '© 2024 BUNNYPOPS. All rights reserved.');
        $footerLogo = Setting::getValue('footer_logo');
        
        return view('admin.settings.footer', compact('footerText', 'footerLogo'));
    }

    public function updateFooter(Request $request)
    {
        $request->validate([
            'footer_text' => 'required|string|max:500',
            'footer_logo' => 'nullable|image|max:2048',
        ]);

        Setting::setValue('footer_text', $request->footer_text);

        if ($request->hasFile('footer_logo')) {
            $footerLogoPath = $request->file('footer_logo')->store('logo', 'public');
            $footerLogoPath = basename($footerLogoPath);
            Setting::setValue('footer_logo', $footerLogoPath);
        }

        return back()->with('success', 'Footer settings updated');
    }

    public function qris()
    {
        $qrisImage = Setting::getValue('qris_image');
        $virtualAccount = Setting::getValue('virtual_account', '1234567890');
        
        return view('admin.settings.qris', compact('qrisImage', 'virtualAccount'));
    }

    public function updateQris(Request $request)
    {
        $request->validate([
            'qris_image' => 'required|image|max:2048',
            'virtual_account' => 'required|string|max:50',
        ]);

        $qrisPath = $request->file('qris_image')->store('qris', 'public');
        $qrisPath = basename($qrisPath);
        
        Setting::setValue('qris_image', $qrisPath);
        Setting::setValue('virtual_account', $request->virtual_account);

        return back()->with('success', 'Payment settings updated');
    }
}