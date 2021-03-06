<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use DB;
use Session;
session_start();
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
class CategoryProduct extends Controller
{
    public function add_category_product()
    {
    	return view('admin/add_category_product');
    }
    public function all_category_product(){
        $all_category_product = Category::orderby('category_id','DESC')->get();
    	$manager_category_product = view('admin/all_category_product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin/all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $data = $request->all();
        $category = new Category();
        $category->category_name = $request->category_product_name;
        $category->category_desc = $request->category_product_desc;
        $category->category_status = $request->category_product_status;
        $category->save();
		Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id){
        Category::where('category_id',$category_product_id)->update(['category_status'=>0]);
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        Category::where('category_id',$category_product_id)->update(['category_status'=>1]);
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $edit_category_product = Category::find($category_product_id);
        $manager_category_product = view('admin/edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin/edit_category_product',$manager_category_product);
    }
    public function delete_category_product($category_product_id){
        Category::find($category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function update_category_product(Request $request, $category_product_id){
        $data = $request->all();
        $category = Category::find($category_product_id);
        $category->category_name = $request->category_product_name;
        $category->category_desc = $request->category_product_desc;
        $category->save();
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    // end function Admin page
    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();
        $category_name = DB::table('tbl_category_product')->where('category_id',$category_id)->limit(1)->get();
        return view('pages/category/show_category')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
}
