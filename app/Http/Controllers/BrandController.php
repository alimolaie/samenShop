<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Admin\Brand;
use DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
class BrandController extends Controller
{
    public function brands()
    {
        $brands=Brand::all();
        return view('admin.category.brand',compact('brands'));
    }
    public function storeBrand(Request $request)
    {
        $this->validate($request, [
            'brand_name' => 'unique:brands|max:255',
            'brand_logo' => 'image|mimes:png,jpg|max:10000',

            ]);
            $imageName="";
            if($request->hasfile('brand_logo')){
            $imageName = 'b-'.md5(time()).'.'.$request->brand_logo->getClientOriginalExtension();
                    //set upload directory
                    $request->brand_logo->move(public_path('uploads/'), $imageName);

        }
        $brands=new Brand();
        $brands->brand_name=$request->input('brand_name');
        $brands->brand_logo = $imageName;
        $brands->slug = SlugService::createSlug(Brand::class,'slug',$request->brand_name);
        $brands->save();
        $notification=array(
            'message'=>'Brand updated successfully',
            'alert-type'=>'success'
             );
             return redirect()->route('brands')->with($notification);

        }
        public function editBrand($id)
        {
            $brand=Brand::find($id);
            return view('admin.category.edit-brand',compact('brand'));

        }
        public function updateBrand(Request $request,$id)
        {

            $brand=Brand::find($id);

            $this->validate($request, [
                'brand_name' => 'unique:brands|max:255',
                'brand_logo' => 'image|mimes:png,jpg|max:10000',

                ]);
                $imageName="";
                if($request->hasfile('brand_logo')){
                $imageName = 'b-'.md5(time()).'.'.$request->brand_logo->getClientOriginalExtension();
                        //set upload directory
                        $request->brand_logo->move(public_path('uploads/'), $imageName);

                        $brand->brand_name=$request->input('brand_name');

                        $brand->brand_logo = $imageName;
                        $brand->save();

                        $notification=array(
                            'message'=>'Brand updated successfully',
                            'alert-type'=>'success'
                             );
                             return redirect()->route('brands')->with($notification);
            }

        }
    }

