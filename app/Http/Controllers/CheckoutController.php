<?php

namespace App\Http\Controllers;

use App\Category;
use DB;
use Session;
session_start();
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use Cart;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function login_checkout(){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages/checkout/login_checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product); 
    }
    public function add_customer(Request $request){
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
    	$data['customer_phone'] = $request->customer_phone;
    	$customer_id = DB::table('tbl_customer')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect::to('/checkout');
    }
    public function checkout(){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages/checkout/show_checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function save_checkout_customer(Request $request){
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_address'] = $request->shipping_address;
    	$data['shipping_note'] = $request->shipping_note;
    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);
    	
    	return Redirect::to('/payment');
    }
    public function payment(){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages/checkout/payment')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function order_place(Request $request){
        $data = array();
        $data['payment_method'] = $request->payment_options;
        $data['payment_status'] = "Dang cho lay hang";
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] =  "Dang cho lay hang";
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $v_content->id;
            $order_details_data['product_name'] = $v_content->name;
            $order_details_data['product_price'] = $v_content->price;
            $order_details_data['product_sales_quantity'] =  $v_content->qty;
            $payment_id = DB::table('tbl_order_details')->insertGetId($order_details_data);
        }
        if($data['payment_status'] == 1){
            echo "Thanh toan bang ATM";
        }
        else{
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
            return view('pages/checkout/handcash')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        }
        // eadforeach
        // return Redirect::to('/payment');
    }
    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
    	if($result){
    		Session::put('customer_id',$result->customer_id);
    		return Redirect::to('/checkout');
    	}
    	else{
    		return Redirect('/login-checkout');
    	}
    	Session::put('customer_id',$customer_id);
    	}
    public function manage_order(){
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manage_order = view('admin/manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin/manage_order',$manage_order);
    }
    public function view_order($orderId){
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')
        ->first();
        $manage_order_by_id = view('admin/view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin/view_order',$manage_order_by_id);
        
    }
}
