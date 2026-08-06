<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'para')->all();
        $logo = Setting::where('para', 'logo')->first();
        
        return view('admin-panel.settings.index', compact('settings', 'logo'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'company_name_ar' => 'required|string',
            'company_name_en' => 'required|string',
            'whatsapp' => 'nullable|url',
            'facebook' => 'nullable|url',
            'email' => 'required|email',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'phone' => 'required|string',
            'primary_color' => 'required|string|regex:/^#[0-9a-fA-F]{6}$/',
            'secondary_color' => 'required|string|regex:/^#[0-9a-fA-F]{6}$/',
            'about_ar' => 'required|string',
            'about_en' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Process Settings updates
        foreach ($data as $key => $value) {
            if ($key === 'logo') continue;
            Setting::where('para', $key)->update(['value' => $value]);
        }

        // Process Logo upload
        if ($request->hasFile('logo')) {
            $logoSetting = Setting::where('para', 'logo')->first();
            if ($logoSetting && $logoSetting->imagepath && file_exists(public_path($logoSetting->imagepath))) {
                @unlink(public_path($logoSetting->imagepath));
            }

            $file = $request->file('logo');
            $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $fileName);
            $logoPath = 'uploads/settings/' . $fileName;

            Setting::where('para', 'logo')->update([
                'imagepath' => $logoPath,
                'value' => $logoPath
            ]);
        }

        return redirect()->back()->with('success', __('adminlte::adminlte.succUpdate') ?? 'تم تحديث البيانات بنجاح.');
    }
}