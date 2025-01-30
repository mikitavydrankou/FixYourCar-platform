<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars';

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year',
        'license_plate',
        'engine_type',
        'transmission',
        'mileage',
        'last_service_date',
        'image',

    ];

    protected $attributes = [
        'image' => 'images/default_car.jpg'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
