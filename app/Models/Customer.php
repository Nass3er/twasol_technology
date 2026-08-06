<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'phone',
        'email',
        'details_ar',
        'details_en',
        'logo',
        'active',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'customer_service');
    }

    public function contracts()
    {
        return $this->hasMany(MaintenanceContract::class);
    }

    public function activeContract()
    {
        return $this->hasOne(MaintenanceContract::class)->where('active', true)->where('end_date', '>=', now()->toDateString())->latest();
    }
}