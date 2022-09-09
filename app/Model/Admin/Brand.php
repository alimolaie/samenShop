<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cocur\Slugify\Slugify;
class Brand extends Model
{
    use Sluggable;
    public $table="brands";
    protected $fillable = [
        'brand_name', 'brand_logo',
    ];
    public function sluggable()
    {
       return [
           'slug'=> [
               'source' =>'	brand_name'
           ]

       ];
    }
}
