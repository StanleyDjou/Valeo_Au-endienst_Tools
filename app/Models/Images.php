<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Images extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'image_path',
    ];

    public function imageable(){
        return $this->morphTo();
    }
    public function getImageAttribute(){
        return asset('storage/'.$this->image_path);
    }

    public function temporaryUrl(){
        return asset('storage/'.$this->image_path);
    }

}
