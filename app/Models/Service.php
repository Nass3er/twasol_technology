<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'price',
        'active',
    ];

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_service');
    }
}