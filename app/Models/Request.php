<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'service_id',
        'status',
        'skills',
        'date'
    ];


    protected $casts = [
        'date'=>'datetime'
    ];


    const STATUS_DRAFT = "draft";
    const STATUS_PENDING = "pending";
    const STATUS_PROCESSING = "processing";
    const STATUS_ASSIGNED = "assigned";
    const STATUS_COMPLETED = "completed";
    const STATUS_CANCELLED = "cancelled";

    const STATUS = [
        self::STATUS_DRAFT, self::STATUS_PENDING, self::STATUS_PROCESSING, self::STATUS_ASSIGNED, self::STATUS_COMPLETED, self::STATUS_CANCELLED
    ];

    public function images(){
        return $this->morphMany(Images::class, 'imageable');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
