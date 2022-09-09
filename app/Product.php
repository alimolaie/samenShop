<?php

namespace App;

use App\Model\Admin\Category;
use App\Model\Admin\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cocur\Slugify\Slugify;

class Product extends Model
{
    use Sluggable;
    protected $guarded = ['id'];
    public function sluggable()
    {
       return [
           'slug'=> [
               'source' =>'product_name'
           ]

       ];
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function hasStock(int $quantity)
    {
        return $this->stock >= $quantity;
    }
}
