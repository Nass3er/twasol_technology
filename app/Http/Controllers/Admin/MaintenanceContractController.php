<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\MaintenanceContract;
use Illuminate\Http\Request;

class MaintenanceContractController extends Controller
{
    public function index()
    {
        $contracts = MaintenanceContract::with('customer')->get();
        $customers = Customer::where('active', true)->get();
        return view('admin-panel.contracts.index', compact('contracts', 'customers'));
    }

    public function create()
    {
        $customers = Customer::where('active', true)->get();
        return view('admin-panel.contracts.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        MaintenanceContract::create($data);

        return redirect()->route('contracts.index', app()->getLocale())->with('success', 'تم إضافة عقد الصيانة بنجاح.');
    }

    public function edit($locale, $id)
    {
        $contract = MaintenanceContract::findOrFail($id);
        $customers = Customer::where('active', true)->get();
        return view('admin-panel.contracts.edit', compact('contract', 'customers'));
    }

    public function update(Request $request, $locale, $id)
    {
        $contract = MaintenanceContract::findOrFail($id);

        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $contract->update($data);

        return redirect()->route('contracts.index', app()->getLocale())->with('success', 'تم تعديل عقد الصيانة بنجاح.');
    }

    public function destroy($locale, $id)
    {
        $contract = MaintenanceContract::findOrFail($id);
        $contract->delete();

        return redirect()->route('contracts.index', app()->getLocale())->with('success', 'تم حذف عقد الصيانة بنجاح.');
    }

    public function toggleActive($locale, $id)
    {
        $contract = MaintenanceContract::findOrFail($id);
        $contract->active = !$contract->active;
        $contract->save();

        return redirect()->back()->with('success', 'تم تغيير حالة التنشيط بنجاح.');
    }

    public function renew(Request $request, $locale, $id)
    {
        $contract = MaintenanceContract::findOrFail($id);

        $request->validate([
            'new_end_date' => 'required|date|after:' . $contract->end_date->toDateString(),
            'renewal_description_ar' => 'nullable|string',
            'renewal_description_en' => 'nullable|string',
        ]);

        // We can either update the current contract or mark current inactive and create a new one.
        // The requirement is "امكانية تجديد هذا العقد لفترة معينه اخرى", updating is simple and robust, 
        // but let's update end_date and append description to keep simple history or just update it.
        $descAr = $contract->description_ar;
        $descEn = $contract->description_en;

        if ($request->filled('renewal_description_ar')) {
            $descAr .= "\n[تجديد في " . now()->toDateString() . "]: " . $request->renewal_description_ar;
        }
        if ($request->filled('renewal_description_en')) {
            $descEn .= "\n[Renewed on " . now()->toDateString() . "]: " . $request->renewal_description_en;
        }

        $contract->update([
            'end_date' => $request->new_end_date,
            'description_ar' => $descAr,
            'description_en' => $descEn,
            'notified_at' => null, // Reset notification status for the renewed period
        ]);

        return redirect()->route('contracts.index', app()->getLocale())->with('success', 'تم تجديد عقد الصيانة بنجاح.');
    }
}