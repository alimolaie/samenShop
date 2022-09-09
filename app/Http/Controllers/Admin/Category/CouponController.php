<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CouponController extends Controller
{
    public function coupon()
    {
        $coupon=DB::table('coupons')->get();
        return view('admin.coupon.coupon',compact('coupon'));
    }
    public function storeCoupon(Request $request)
    {
        $validateData=$request->validate([
            'coupon' => 'required',
            'discount' => 'required'
        ]);
        $data['coupon']=$request->coupon;
        $data['discount']=$request->discount;
        DB::table('coupons')->insert($data);
        $notification=array(
            'message'=>' Coupons Add successfully',
            'alert-type'=>'success'
             );
             return redirect()->route('admin.coupon')->with($notification);
    }
    public function deleteCoupon($id)
    {
       DB::table('coupons')->where('id',$id)->delete();
       $notification=array(
        'message'=>' Coupons Delete successfully',
        'alert-type'=>'success'
         );
         return redirect()->back()->with($notification);
    }
    public function editCoupon($id)
    {
        $coupon= DB::table('coupons')->where('id',$id)->first();

        return view('admin.coupon.edit',compact('coupon'));
    }
    public function updateCoupon(Request $request,$id)
    {
        $data=array();
        $data['coupon']=$request->coupon;
        $data['discount']=$request->discount;
        DB::table('coupons')->where('id',$id)->update($data);
        $notification=array(
            'message'=>'Coupon update successfully',
            'alert-type'=>'success'
             );
             return redirect()->route('admin.coupon')->with($notification);
    }
    public function newslaters()
    {
        $newslater=DB::table('newslaters')->get();
        return view('admin.coupon.newslaters',compact('newslater'));
    }
}
