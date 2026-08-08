<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'service_id',
        'service_name',
        'message',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
