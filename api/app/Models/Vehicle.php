<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'brand', 
        'model', 
        'license_plate',
    ];

    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservations::class);
    }
}
