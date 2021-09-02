<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;

class AdminController extends Controller
{
    public function Dashboard(){
        return view('admin.admin_dashboard');
    }

    public function login(Request $request){
        if($request-> isMethod('post')){
            $data =$request ->all();
           //echo "<pre>" ; print_r ($data) ;

           $rules =[
            'email' => 'required|email',
            'password' => 'required',
           ];
           $messages =[
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'ادخل عنوان بريد إلكتروني صالح.',
            'password.required' => 'كلمة المرور مطلوبة.'
           ];
           $this->validate($request,$rules,$messages);

           if(Auth::guard('admin')-> attempt(['email' => $data['email'], 'password' => $data['password']])){
               return redirect()->route('admin.dashboard');
           }else {
               Session::flash('error_message','Invalid Email or Password');
               return redirect()->back();
           }
        }


        return view('admin.admin_login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function settings(){
         $admindetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();

        return view('admin.admin_settings',compact('admindetails'));
    }

    public function checkCuurentPassword(Request $request){
        $data = $request->all();
        //echo"<pre>";print_r($data);die;
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
            echo "true";
        }else {
            echo "false";
        }
    }

    public function updateCuurentPassword(Request $request){
        if($request ->isMethod('post')){
            $data = $request -> all();
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                if($data['new_password'] == $data['confirm_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' =>bcrypt($data['new_password'])]);
                    //Session::flash('success_message','Password has been Updated Successfully ');
                    Session::flash('success_message','Password has been Updated Successfully ');
                    return redirect()->back();
                }else {
                    Session::flash('error_message','New password and Confirm password not match ');
                    return redirect()->back();
                }
            }else {
                Session::flash('error_message','Your Current password is incorrect ');
                return redirect()->back();
            }
        }
    }
    public function updateAdminDetails(Request $request){
        $admindetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        try {
            if($request ->isMethod('post')){
                $data = $request->all();
                //echo "<pre>" ; print_r ($data) ;

                $rules =[
                    'admin_name' => 'required|alpha',
                    'admin_mobile' => 'required|numeric',
                    'admin_image' => 'image',
                   ];
                   $messages =[
                    'admin_name.required' => ' Name is Required',
                    'admin_name.alpha' => 'Valid Name is Required',
                    'admin_mobile.required' => ' Mobile is Required',
                    'admin_mobile.numeric' => 'Valid Mobile is Required',
                    'admin_image.image' => 'Valid Image is Required',
                   ];
                   $this->validate($request,$rules,$messages);

                   Admin::where('id',Auth::guard('admin')->user()->id)->update([
                       'name' => $data['admin_name'],
                       'mobile' => $data['admin_mobile'],
                   ]);
                   Session::flash('success_message','Admin Details has been Updated Successfully ');
                   return redirect()->back();
            }
        } catch (\Throwable $th) {
            return $th;
        }

        return view('admin.updata_admin_details',compact('admindetails'));
    }
}
