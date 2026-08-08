<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::latest()->paginate(15);
        return view('admin-panel.service-requests.index', compact('requests'));
    }

    public function destroy($locale, $id)
    {
        $request = ServiceRequest::findOrFail($id);
        $request->delete();

        return redirect()->back()->with('success', 'تم حذف الطلب بنجاح.');
    }
}
