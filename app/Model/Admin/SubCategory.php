<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cocur\Slugify\Slugify;
class SubCategory extends Model
{
    use Sluggable;
    public $table="subcategories";
    protected $fillable = [
        'category_id', 'subcategory_name'
    ];
    public function category()
    {
        $this->belongsTo(Category::class);
    }
    public function sluggable()
    {
       return [
           'slug'=> [
               'source' =>'subcategory_name'
           ]

       ];
    }
}
