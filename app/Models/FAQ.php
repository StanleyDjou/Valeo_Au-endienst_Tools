<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAQ extends Model
{
    use HasFactory, SoftDeletes;

    protected $table  = "faqs";

    protected $fillable = [
        'question',
        'answer',
        'category_id'
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function($model){
            $model->search_index = implode("  ", array_values($model->attributes));
            $model->save();
        });

        self::updated(function($model){
            if(!isset($model->changes["search_index"])){
                $model->search_index = implode("  ", array_values($model->attributes));
                $model->save();
            }
        });
    }

    public function category(){
       return $this->belongsTo(Category::class, 'category_id');
    }

    public function categoryName(){
        $category = Category::find($this->category_id);
        return $category->name;
    }
}
