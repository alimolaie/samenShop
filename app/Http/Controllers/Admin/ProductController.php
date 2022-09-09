<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
use App\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProductController extends Controller
{

    public function index()
    {
        $product=DB::table('products')->join('categories','products.category_id','categories.id')->join('brands','products.brand_id','brands.id')->select('products.*','categories.category_name','brands.brand_name')->get();
        return view('admin.product.index',compact('product'));
    }
    public function create()
    {
        //get data category and brand in product tables
        $category=DB::table('categories')->get();
        $brand=DB::table('brands')->get();

        return view('admin.product.create',compact('category','brand'));
     }
     public function getSubCategory($category_id)
     {
        //get sub category from ajax and db
        $cat=DB::table('subcategories')->where('category_id',$category_id)->get();
        return json_encode($cat);
     }
      public function store(Request $request)
      {

        //upload image one
		$imageOneName="";
		if($request->hasfile('image_one')){

        $imageOneName=hexdec(uniqid()).'.'.$request->image_one->getClientOriginalExtension();

        Image::make($request->image_one)->resize(300,300)->save('uploads/products/'. $imageOneName);

		}
        //upload image two
        $imageTwoName="";
		if($request->hasfile('image_two')){

        $imageTwoName=hexdec(uniqid()).'.'.$request->image_two->getClientOriginalExtension();

        Image::make($request->image_two)->resize(300,300)->save('uploads/products/'.$imageTwoName);

		}
        //upload image three
        $imageThreeName="";
		if($request->hasfile('image_three')){

        $imageThreeName=hexdec(uniqid()).'.'.$request->image_three->getClientOriginalExtension();
        Image::make($request->image_three)->resize(300,300)->save('uploads/products/'.$imageThreeName);

		}
        //indentify feild of product table
        $product=new Product();
        $product->product_name=$request->input('product_name');
        $product->product_code=$request->input('product_code');
        $product->product_quantity=$request->input('product_quantity');
        $product->category_id=$request->input('category_id');

        $product->brand_id=$request->input('brand_id');
        $product->product_color=$request->input('product_color');
        $product->product_size=$request->input('product_size');
        $product->selling_price=$request->input('selling_price');
        $product->product_details=$request->input('product_details');
        $product->video_link=$request->input('video_link');
        $product->main_slider=$request->input('main_slider');
        $product->hot_deal=$request->input('hot_deal');
        $product->best_rated=$request->input('best_rated');
        $product->trend=$request->input('trend');
        $product->mid_slider=$request->input('mid_slider');
        $product->hot_new=$request->input('hot_new');
        $product->image_one=$imageOneName;
        $product->image_two=$imageTwoName;
        $product->image_three=$imageThreeName;
        $product->slug = SlugService::createSlug(Product::class,'slug',$request->product_name);
        //insert to database
        $product->save();
        $notification=array(
            'message'=>'Product insert successfully',
            'alert-type'=>'success'
             );
             return redirect()->route('all.product')->with($notification);

        }
        public function edit($id)
        {
            $product=DB::table('products')->where('id',$id)->first();
            return view('admin.product.edit',compact('product'));
        }


        public function update(Request $request,$id)
        {
            $product=Product::find($id);
             //upload image one
		$imageOneName=$product->image_one;
		if($request->hasfile('image_one')){

        $imageOneName=hexdec(uniqid()).'.'.$request->image_one->getClientOriginalExtension();

        Image::make($request->image_one)->resize(300,300)->save('uploads/products/'. $imageOneName);

		}
        //upload image two
        $imageTwoName=$product->image_two;
		if($request->hasfile('image_two')){

        $imageTwoName=hexdec(uniqid()).'.'.$request->image_two->getClientOriginalExtension();

        Image::make($request->image_two)->resize(300,300)->save('uploads/products/'.$imageTwoName);

		}
        //upload image three
        $imageThreeName=$product->image_three;
		if($request->hasfile('image_three')){

        $imageThreeName=hexdec(uniqid()).'.'.$request->image_three->getClientOriginalExtension();
        Image::make($request->image_three)->resize(300,300)->save('uploads/products/'.$imageThreeName);

		}
        //if you write new record don't update insert new record

        //indentify feild of product table

        $product->product_name=$request->input('product_name');
        $product->product_code=$request->input('product_code');
        $product->product_quantity=$request->input('product_quantity');
        $product->category_id=$request->input('category_id');
    
        $product->brand_id=$request->input('brand_id');
        $product->product_color=$request->input('product_color');
        $product->product_size=$request->input('product_size');
        $product->selling_price=$request->input('selling_price');
        $product->product_details=$request->input('product_details');
        $product->video_link=$request->input('video_link');
        $product->main_slider=$request->input('main_slider');
        $product->hot_deal=$request->input('hot_deal');
        $product->best_rated=$request->input('best_rated');
        $product->trend=$request->input('trend');
        $product->mid_slider=$request->input('mid_slider');
        $product->hot_new=$request->input('hot_new');
        $product->image_one=$imageOneName;
        $product->image_two=$imageTwoName;
        $product->image_three=$imageThreeName;
        //update to database
        $product->save();
        $notification=array(
            'message'=>'Product update successfully',
            'alert-type'=>'success'
             );
             return redirect()->route('all.product')->with($notification);

        }

        public function active($id)
        {
            //change status to Active
            DB::table('products')->where('id',$id)->update(['status'=>1]);
            $notification=array(
                'message'=>'Product successfully inActive',
                'alert-type'=>'success'
                 );
                 return redirect()->back()->with($notification);
        }
        public function inActive($id)
        {
            //change status to inActive
            DB::table('products')->where('id',$id)->update(['status'=>0]);
            $notification=array(
                'message'=>'Product successfully inActive',
                'alert-type'=>'success'
                 );
                 return redirect()->back()->with($notification);
        }
        public function destroy($id)
        {
            $product=Product::find($id);
            $image1=asset('/uploads/products/'.$product->image_one);
            $image2=asset('/uploads/products/'.$product->image_two);
            $image3=asset('/uploads/products/'.$product->image_three);

            if (!empty($image1)) {
                $web_image_path = "/uploads/products/" . $image1;

                if (File::exists(public_path($web_image_path))) {
                    File::delete(public_path($web_image_path));
                }
            }
            if (!empty($image2)) {
                $web_image_path = "/uploads/products/" . $image2;

                if (File::exists(public_path($web_image_path))) {
                    File::delete(public_path($web_image_path));
                }
            }
            if (!empty($image3)) {
                $web_image_path = "/uploads/products/" . $image3;

                if (File::exists(public_path($web_image_path))) {
                    File::delete(public_path($web_image_path));
                }
            }


            $product->delete();
            $notification=array(
                'message'=>'Product delete succsess',
                'alert-type'=>'danger'
                 );
                 return redirect()->route('all.product')->with($notification);

        }

}
