<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('services')->get();
        return view('admin-panel.customers.index', compact('customers'));
    }

    public function create()
    {
        $services = Service::where('active', true)->get();
        return view('admin-panel.customers.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'details_ar' => 'nullable|string',
            'details_en' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        if ($request->hasFile('logo')) {
            $uploadDir = public_path('uploads/customers');
            if (!file_exists($uploadDir)) {
                @mkdir($uploadDir, 0755, true);
            }

            $altDirs = [
                base_path('public/uploads/customers'),
                base_path('public_html/uploads/customers'),
                base_path('../public_html/uploads/customers'),
            ];
            foreach ($altDirs as $altDir) {
                if (!file_exists($altDir) && file_exists(dirname($altDir))) {
                    @mkdir($altDir, 0755, true);
                }
            }

            $file = $request->file('logo');
            $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $data['logo'] = 'uploads/customers/' . $fileName;

            foreach ($altDirs as $altDir) {
                if (file_exists($altDir) && realpath($altDir) !== realpath($uploadDir)) {
                    @copy($uploadDir . '/' . $fileName, $altDir . '/' . $fileName);
                }
            }
        }

        $customer = Customer::create($data);

        if (!empty($request->services)) {
            $customer->services()->sync($request->services);
        }

        return redirect()->route('customers.index', app()->getLocale())->with('success', 'تم إضافة العميل بنجاح.');
    }

    public function edit($locale, $id)
    {
        $customer = Customer::with('services')->findOrFail($id);
        $services = Service::where('active', true)->get();
        $selectedServices = $customer->services->pluck('id')->toArray();
        
        return view('admin-panel.customers.edit', compact('customer', 'services', 'selectedServices'));
    }

    public function update(Request $request, $locale, $id)
    {
        $customer = Customer::findOrFail($id);

        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'details_ar' => 'nullable|string',
            'details_en' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        if ($request->hasFile('logo')) {
            if ($customer->logo && file_exists(public_path($customer->logo))) {
                @unlink(public_path($customer->logo));
            }
            $file = $request->file('logo');
            $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/customers'), $fileName);
            $data['logo'] = 'uploads/customers/' . $fileName;
        }

        $customer->update($data);
        $customer->services()->sync($request->input('services', []));

        return redirect()->route('customers.index', app()->getLocale())->with('success', 'تم تعديل العميل بنجاح.');
    }

    public function destroy($locale, $id)
    {
        $customer = Customer::findOrFail($id);
        if ($customer->logo && file_exists(public_path($customer->logo))) {
            @unlink(public_path($customer->logo));
        }
        $customer->delete();

        return redirect()->route('customers.index', app()->getLocale())->with('success', 'تم حذف العميل بنجاح.');
    }

    public function toggleActive($locale, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->active = !$customer->active;
        $customer->save();

        return redirect()->back()->with('success', 'تم تغيير حالة التنشيط بنجاح.');
    }
}