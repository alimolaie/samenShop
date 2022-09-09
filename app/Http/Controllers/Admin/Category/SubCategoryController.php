<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\SubCategory;
use Illuminate\Http\Request;



use DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
class SubCategoryController extends Controller
{
    public function subCategory()
    {
        $category=DB::table('categories')->get();
        $subCategory=DB::table('subcategories')->join('categories','subcategories.category_id','categories.id')->select('subcategories.*','categories.category_name')->get();
        return view('admin.category.sub-category',compact('category','subCategory'));
    }
    public function storeSubCategory(Request $request)
    {
        $validateData=$request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',

        ]);
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        $data['subcategory_name']=$request->subcategory_name;
        $data['slug'] = SlugService::createSlug(subCategory::class,'slug',$request->subcategory_name);
        DB::table('subcategories')->insert($data);
        $notification=array(
            'message'=>'Sub Category Add successfully',
            'alert-type'=>'success'
             );
             return redirect()->route('subCategories')->with($notification);
    }
    public function editSubCategory($id)
    {
        $subCategory= DB::table('subcategories')->where('id',$id)->first();
        $category=DB::table('categories')->get();
        return view('admin.category.edit-sub-category',compact('subCategory','category'));
    }
    public function updateSubCategory(Request $request,$id)
    {
        $data=array();
        $data['category_id']=$request->category_id;
        $data['subcategory_name']=$request->subcategory_name;
        DB::table('subcategories')->where('id',$id)->update($data);
        $notification=array(
            'message'=>'Sub Category update successfully',
            'alert-type'=>'success'
             );
             return redirect()->route('subCategories')->with($notification);
    }
}
