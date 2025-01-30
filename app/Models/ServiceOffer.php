<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceOffer extends Model
{
    use HasFactory;

    /**
     * @var mixed|string
     */

    protected $table = 'service_offers';

    protected $fillable = [
        'service_id',
        'service_request_id',
        'price',
        'description',
        'date',
        'time',
        'status'
    ];



    protected $attributes = [
        'status' => 'sent',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class);
    }
}
