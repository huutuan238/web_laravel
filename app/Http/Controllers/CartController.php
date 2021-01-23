<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
session_start();
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use Cart;

class CartController extends Controller
{
    public function save_cart(Request $request){
    	$productId = $request->productid_hidden;
    	$qty = $request->qty;
    	$product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
    	
        // Cart::add('293ad', 'Product 1', 1, 9.99);
        // Cart::destroy();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $qty;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;        
        Cart::add($data);
        // Cart::destroy();
        return Redirect::to('/show-cart');
    }
    public function show_cart(){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('cart/show_cart')->with('cate_product',$cate_product)->with('brand_product',$brand_product);    	
    }
    public function delte_to_cart($rowId){
    	// Cart::update($rowId,0);
    	Cart::remove($rowId);
    	return Redirect::to('/show-cart');
    }
}
