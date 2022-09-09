<?php

namespace App\Model\Admin;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cocur\Slugify\Slugify;
class Category extends Model
{
    use Sluggable;
    public $table="categories";
    protected $fillable = [
        'category_name',
    ];
    public function subCategory()
    {
        $this->hasMany(SubCategory::class);
    }
    public function product()
    {
        $this->hasMany(Product::class);
    }
    public function sluggable()
    {
       return [
           'slug'=> [
               'source' =>'category_name'
           ]

       ];
    }
    public function childs()
    {
        return $this->hasMany('App\Model\Admin\Category', 'parent_id','id');
    }
    //tree
    public static function tree() {
        return static::with(implode('.', array_fill(0, 100, 'childs')))->where('parent_id', '=', '0')->get();
    }

    //categories for website menus

    public static function CategoriesTree() {
        return static::with(implode('.', array_fill(0, 100, 'childs')))->where('parent_id', '=', '0')->get();
    }
}
