<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index(){
    	return view('admin_login');
    }
    public function showdashboard(){
    	return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $login = DB::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        return Redirect::to('/dashboard');
        echo "<pre>";
        print_r($login);
        echo "</pre>";
        // if($login){
        //     $login_count = $login->count();
        //     if($login_count>0){
        //         Session::put('admin_name',$login->admin_name);
        //         Session::put('admin_id',$login->admin_id);
        //         return Redirect::to('/dashboard');
        //     }
        // }else{
        //         Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
        //         return Redirect::to('/admin');
        // }
    }
}
