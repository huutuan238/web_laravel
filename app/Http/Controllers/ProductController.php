<?php

namespace App\Http\Controllers;


use DB;
use Session;
use App\Brand;
use App\Category;
use App\Product;
session_start();
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add_product()
    {	
    	$cate_product = Category::orderby('category_id','desc')->get();
    	$brand_product = Brand::orderby('brand_id','desc')->get();
    	return view('admin/add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product(){
    	$all_product = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    	->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
    	->orderby('tbl_product.product_id','desc')->get();
    	$manager_product = view('admin/all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin/all_product',$manager_product);
    }
    public function save_product(Request $request){
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_price'] = $request->product_price;
    	$data['product_image'] = $request->product_image;
    	$data['product_desc'] = $request->product_desc;
    	$data['product_content'] = $request->product_content;
    	$data['category_id'] = $request->product_cate;
    	$data['brand_id'] = $request->product_brand;
    	$data['product_status'] = $request->product_status;
    	$get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all-product');	
    }
    public function unactive_product($product_id){
        Product::find($product_id)->update(['product_status'=>0]);
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        Product::find($product_id)->update(['product_status'=>1]);
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
    	$cate_product = Category::orderby('category_id','desc')->get();
    	$brand_product = Brand::orderby('brand_id','desc')->get();
        $edit_product = Product::find($product_id);
        $manager_product = view('admin/edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin/edit_product',$manager_product);
    }
    public function delete_product($product_id){
        Product::find($product_id)->delete();
        Session::put('message','Xóa  sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function update_product(Request $request, $product_id){
        $data = $request->all();
        $product = Product::find($product_id);
        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $get_image = $request->file('product_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $data['product_image'] = $new_image;
                    $product->save();
                    Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('all-product');
        }
            
        // Product::where('product_id',$product_id)->update($product);
        $product->save();
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //end function admin
    public function details_product($product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
        //sp goi y(lay cung category)
        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        //end sp lien quan
        return view('pages/product/show_details')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('details_product',$details_product)->with('related_product',$related_product);
    }
}
