<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PostController extends Controller
{

    public function blogCategoryList()
    {
        $blogCategory=DB::table('post_category')->get();
        return view('admin.blog.category',compact('blogCategory'));
    }
    public function storeBlogCategory(Request $request)
    {
        $validateData=$request->validate([

            'category_name_en' => 'required|max:255',
            'category_name_fa' =>  'required|max:255'


        ]);
        $data=array();
        $data['category_name_en']=$request->category_name_en;
        $data['category_name_fa']=$request->category_name_fa;
        DB::table('post_category')->insert($data);
        $notification=array(
            'message'=>'Blog Category insert Succsess',
            'alert-type'=>'success'
             );
             return redirect()->route('add.blog.categorylist')->with($notification);

    }
    public function deleteBlogCategory($id)
    {
        DB::table('post_category')->where('id',$id)->delete();
        $notification=array(
            'message'=>'Blog Category delete Succsess',
            'alert-type'=>'success'
             );
             return redirect()->route('add.blog.categorylist')->with($notification);

    }
    public function editBlogCategory($id)
    {
        $blogCategoryEdit=DB::table('post_category')->where('id',$id)->first();
        return view('admin.blog.edit-category',compact('blogCategoryEdit'));
    }
    public function updateBlogCategory(Request $request,$id)
    {
        $validateData=$request->validate([

            'category_name_en' => 'required|max:255',
            'category_name_fa' =>  'required|max:255'


        ]);
        $data=array();
        $data['category_name_en']=$request->category_name_en;
        $data['category_name_fa']=$request->category_name_fa;
        DB::table('post_category')->where('id',$id)->update($data);
        $notification=array(
            'message'=>'Blog Category update Succsess',
            'alert-type'=>'success'
             );
             return redirect()->route('add.blog.categorylist')->with($notification);
    }
}
