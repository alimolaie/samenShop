<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
class CategoryController extends Controller
{
    public function category()
    {
        $categories    = Category::all();

       return view('admin.category.category',compact('categories'))->with('childs');
    }
    public function storeCategory(Request $request)
    {
        $validationData=$request->validate([

            'category_name'=> 'required|unique:categories|max:255',

        ]);

        $category =new Category();
        $category->parent_id=$request->input('parent_id');
        $category->category_name=$request->category_name;
        $category->slug = SlugService::createSlug(Category::class,'slug',$request->category_name);
        $category->save();
             return back()->with('success','category added successfully');
    }
    public function deleteCategory($id,Request $request,Category $category)
    {
        if ($request->ajax()){

            $category = Category::findOrFail($id);

            if ($category){

                $category->delete();

                return response()->json(array('success' => true));
            }

        }
    }
    public function editCategory($id)
    {
        $categories   = Category::where('parent_id', '=', 0)->get();
       $category= Category::find($id);
        return view('admin.category.edit',compact('category','categories'));
    }
    public function updateCategory(Request $request,$id)
    {
        $category= Category::find($id);
        $validationData=$request->validate([

            'category_name'=> 'required|unique:categories|max:255',


        ]);

        $update=$category->update($validationData);
        if($update){
            $notification = array(
                'message '=>'category updated successfully',
                'alert-type'=>'success'
                 );
                 return redirect()->route('categories')->with($notification);
        }
        else{
            $notification=array(
                'message'=>'Nothings to update',
                'alert-type'=>'error'
                 );
                 return redirect()->route('categories')->with($notification);

        }



    }

}
