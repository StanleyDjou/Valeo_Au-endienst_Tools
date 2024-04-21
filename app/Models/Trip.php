<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
       'start_date',
       'distance',
       'hotel_price',
        'end_date',
        'location'
    ];

    public function workers(){
        return $this->hasMany(UserTrip::class, 'trip_id');
    }

    public function days(){
        $start = strtotime($this->start_date);
        $end = strtotime($this->end_date);
        $datediff = $end - $start;
        return round($datediff / (60 * 60 * 24));
    }

    public function hotel_total(){

        return $this->days()*$this->hotel_price * $this->workers()->count();
    }

    public function food_total(){
        return Constant::find(3)->value * $this->workers()->count();
    }

    public function transport_total(){
        return Constant::find(1)->value*((Constant::find(2)->value/100)*$this->distance);
    }



    }
