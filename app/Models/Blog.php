<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'image',
        'description',
        'category_id',
        'type',
        'path',
        'status',
        'posted_by',
        'created_at'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function publisher(){
        $publisher = User::find($this->posted_by);
        return $publisher->name;
    }

    public function coverImage(){
        return asset('storage/'.$this->image);
    }

    public function url(){
        if($this->type == 'video'){
            return $this->path;
        }
        else{
            return;
        }
    }

    public function scopeText($builder){
        return $builder->where('type', 'text')->get();
    }


    public function scopeVideo($builder){
        return $builder->where('type', 'video')->get();
    }

    public function comments(){
        return Comment::where('blog_id', $this->id)->get();
    }
}
