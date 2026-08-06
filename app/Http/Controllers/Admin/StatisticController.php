<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::all();
        return view('admin-panel.general.statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('admin-panel.general.statistics.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string|max:255',
            'description_en' => 'nullable|string|max:255',
            'number' => 'required|string|max:50',
            'icon' => 'nullable|string|max:255',
        ]);

        Statistic::create($data);

        return redirect()->route('statistics.index', app()->getLocale())->with('success', 'تم إضافة الإحصائية بنجاح.');
    }

    public function edit($locale, $id)
    {
        $statistic = Statistic::findOrFail($id);
        return view('admin-panel.general.statistics.edit', compact('statistic'));
    }

    public function update(Request $request, $locale, $id)
    {
        $statistic = Statistic::findOrFail($id);

        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string|max:255',
            'description_en' => 'nullable|string|max:255',
            'number' => 'required|string|max:50',
            'icon' => 'nullable|string|max:255',
        ]);

        $statistic->update($data);

        return redirect()->route('statistics.index', app()->getLocale())->with('success', 'تم تعديل الإحصائية بنجاح.');
    }

    public function destroy($locale, $id)
    {
        $statistic = Statistic::findOrFail($id);
        $statistic->delete();

        return redirect()->route('statistics.index', app()->getLocale())->with('success', 'تم حذف الإحصائية بنجاح.');
    }

    public function toggleActive($locale, $id)
    {
        $statistic = Statistic::findOrFail($id);
        $statistic->active = !$statistic->active;
        $statistic->save();

        return redirect()->back()->with('success', 'تم تغيير حالة التنشيط بنجاح.');
    }
}