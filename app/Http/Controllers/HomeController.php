<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MaintenanceContract;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalServices = Service::where('active', true)->count();
        $totalCustomers = Customer::where('active', true)->count();
        $activeContracts = MaintenanceContract::where('active', true)->whereDate('end_date', '>=', now()->toDateString())->count();
        $expiringContracts = MaintenanceContract::where('active', true)
            ->whereDate('end_date', '>=', now()->toDateString())
            ->whereDate('end_date', '<=', now()->addDays(30)->toDateString())
            ->with('customer')
            ->get();

        return view('dashboard', compact(
            'totalServices',
            'totalCustomers',
            'activeContracts',
            'expiringContracts'
        ));
    }
}