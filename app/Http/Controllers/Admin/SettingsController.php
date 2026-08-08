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
            $uploadDir = public_path('uploads/settings');
            if (!file_exists($uploadDir)) {
                @mkdir($uploadDir, 0755, true);
            }

            $altDirs = [
                base_path('public/uploads/settings'),
                base_path('public_html/uploads/settings'),
                base_path('../public_html/uploads/settings'),
            ];
            foreach ($altDirs as $altDir) {
                if (!file_exists($altDir) && file_exists(dirname($altDir))) {
                    @mkdir($altDir, 0755, true);
                }
            }

            $logoSetting = Setting::where('para', 'logo')->first();
            if ($logoSetting && $logoSetting->imagepath && file_exists(public_path($logoSetting->imagepath))) {
                @unlink(public_path($logoSetting->imagepath));
            }

            $file = $request->file('logo');
            $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $logoPath = 'uploads/settings/' . $fileName;

            foreach ($altDirs as $altDir) {
                if (file_exists($altDir) && realpath($altDir) !== realpath($uploadDir)) {
                    @copy($uploadDir . '/' . $fileName, $altDir . '/' . $fileName);
                }
            }

            Setting::where('para', 'logo')->update([
                'imagepath' => $logoPath,
                'value' => $logoPath
            ]);
        }

        return redirect()->back()->with('success', __('adminlte::adminlte.succUpdate') ?? 'تم تحديث البيانات بنجاح.');
    }
}