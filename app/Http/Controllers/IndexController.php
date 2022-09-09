<?php

namespace App\Http\Controllers;

use App\Support\Storage\Constract\StorageInterface;
use App\Support\Storage\SessionStorage;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\SubCategory;
use DB;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;

class IndexController extends Controller
{
    public function index()
    {
        $categories=Category::all();
        $products = Product::all();
        $featured=Product::where('hot_deal','=',1)->get();
        $bestRated=Product::where('best_rated','=',1)->get();
        $onSale=Product::where('hot_new','=',1)->get();
        return view('pages.index',compact('categories','featured','bestRated','onSale','products'));
    }
    public function storeNewslater(Request $request)
    {
        $validationData=$request->validate([
            'email' => 'unique:newslaters|max:55'
        ]);
        $data=array();
        $data['email']=$request->email;

        DB::table('newslaters')->insert($data);
        $notification=array(
            'message'=>' Thanks for subcribing',
            'alert-type'=>'success'
             );
             return redirect()->back()->with($notification);
    }
    public function cart()
    {
        return view('cart');
    }
    public function payment()
    {
        return view('payment');
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "product_name" => $product->product_name,
                "quantity" => 1,
                "selling_price" => $product->selling_price,
                "image_one" => $product->image_one
            ];
        }
        $toaster=Toastr::success('Product added to cart successfully!');
        session()->put('cart', $cart);
        return redirect()->back()->with($toaster);
    }
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function removeCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
