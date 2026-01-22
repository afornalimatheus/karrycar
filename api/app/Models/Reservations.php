<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'consumer_id',
        'start_time',
        'end_time',
        'status',
        'total_price',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function consumer()
    {
        return $this->belongsTo(User::class, 'consumer_id');
    }

    public function provider()
    {
        return $this->vehicle->provider();
    }

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->where('start_time', '<', $endDate)
              ->where('end_time', '>', $startDate);
        });
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
