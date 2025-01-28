<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $table = 'service_requests';

    protected $fillable = [
        'user_id',
        'car_id',
        'problem_description',
        'urgency',
        'status',
        'location',
        'attachments',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::created(function ($clientRequest) {
            $car = $clientRequest->car;
            if ($car) {
                $car->status = '2';
                $car->save();
            }
        });
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function serviceOffers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ServiceOffer::class);
    }

    public function selectedServiceOffer(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ServiceOffer::class)->where('status', 'accepted');
    }
}
