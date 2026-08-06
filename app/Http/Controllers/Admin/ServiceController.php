<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('images')->get();
        return view('admin-panel.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin-panel.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $service = Service::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/services'), $fileName);
                $filePath = 'uploads/services/' . $fileName;
                
                $service->images()->create([
                    'image_path' => $filePath
                ]);
            }
        }

        return redirect()->route('services.index', app()->getLocale())->with('success', 'تم إضافة الخدمة بنجاح.');
    }

    public function edit($locale, $id)
    {
        $service = Service::with('images')->findOrFail($id);
        return view('admin-panel.services.edit', compact('service'));
    }

    public function update(Request $request, $locale, $id)
    {
        $service = Service::findOrFail($id);

        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $service->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/services'), $fileName);
                $filePath = 'uploads/services/' . $fileName;

                $service->images()->create([
                    'image_path' => $filePath
                ]);
            }
        }

        return redirect()->route('services.index', app()->getLocale())->with('success', 'تم تعديل الخدمة بنجاح.');
    }

    public function destroy($locale, $id)
    {
        $service = Service::findOrFail($id);
        
        // Delete associated files
        foreach ($service->images as $img) {
            if (file_exists(public_path($img->image_path))) {
                @unlink(public_path($img->image_path));
            }
        }
        $service->delete();

        return redirect()->route('services.index', app()->getLocale())->with('success', 'تم حذف الخدمة بنجاح.');
    }

    public function destroyImage(Request $request, $locale, $id)
    {
        $img = ServiceImage::findOrFail($id);
        if (file_exists(public_path($img->image_path))) {
            @unlink(public_path($img->image_path));
        }
        $img->delete();

        return response()->json(['success' => true]);
    }

    public function toggleActive($locale, $id)
    {
        $service = Service::findOrFail($id);
        $service->active = !$service->active;
        $service->save();

        return redirect()->back()->with('success', 'تم تغيير حالة التنشيط بنجاح.');
    }
}