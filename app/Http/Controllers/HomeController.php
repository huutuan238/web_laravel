<?php

namespace App\Http\Controllers;
use DB;
use Session;
session_start();
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	$all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(3)->get();
    	return view('pages/home')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('all_product',$all_product);
    }
    public function search(Request $request){
    	$keyword = $request->keyword_submit;

    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	$search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
    	return view('pages/product/search')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('search_product',$search_product);
    }
}
