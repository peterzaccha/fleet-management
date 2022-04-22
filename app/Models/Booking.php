<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'trip_id', 'start_id', 'end_id', 'seats'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function from()
    {
        return $this->belongsTo(City::class, 'start_id');
    }
    public function to()
    {
        return $this->belongsTo(City::class, 'end_id');
    }
}
