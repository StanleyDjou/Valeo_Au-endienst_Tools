<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    const TYPE_BLOG = "blog";
    const TYPE_FAQ = "faq";


    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'type',
        'parent_id'
    ];

    public function blogs(){
        return $this->hasMany(Blog::class, 'category_id');
    }

    public function faqs(){
        return $this->hasMany(FAQ::class, 'category_id');
    }

    public function categories(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeBlog($builder){
        return $builder->where('type', self::TYPE_BLOG)->get();
    }


    public function scopeFaq($builder){
        return $builder->where('type', self::TYPE_FAQ)->get();
    }



    public function createSub($data){
        $data['parent_id'] = $this->id;
        return Category::create($data);
    }
}
