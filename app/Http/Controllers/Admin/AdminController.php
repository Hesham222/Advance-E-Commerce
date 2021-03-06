<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Image;
use Session;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');
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
            'email.required' => 'Email is Required',
            'email.email' => 'Valid Email',
            'password.required' => 'Password is Required'
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
        Session::put('page','settings');

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


            $rules =[
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required',
               ];

               $messages =[
                'current_password.required' => ' Current Password is Required',
                'new_password.required' => 'Current Password is Required',
                'confirm_password.required' => 'Confirm Password is Required',
               ];

              $this->validate($request,$rules,$messages);


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
        Session::put('page','update-admin-details');

        $admindetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
        try {

            if($request ->isMethod('post')){
                $data = $request->all();
                //echo "<pre>" ; print_r ($data) ;

                $rules =[
                    'admin_name' => 'required|string',
                    'admin_mobile' => 'required',
                    'admin_image' => 'required|mimes:jpg,jpeg,png',
                   ];

                   $messages =[
                    'admin_name.required' => ' Name is Required',
                    'admin_name.string' => 'Valid Name is Required',
                    'admin_mobile.required' => ' Mobile is Required',
                    'admin_image.required' => 'Valid Image is Required',
                   ];

                  $this->validate($request,$rules,$messages);


                   if($request->hasFile('admin_image')){
                       if($request -> admin_image -> isValid()){
                            $fileExtension =$request -> admin_image -> getClientOriginalExtension();
                            $fileName = time().'.'.$fileExtension;
                            $path = 'images/admin_images/admin_photos';
                            $request -> admin_image ->move($path,$fileName);
                       }else if(!empty($data['current_admin_image'])){
                                    $imagePath = $data['current_admin_image'];
                        }else {
                                   $imagePath = "";
                        }
                        Admin::where('id',Auth::guard('admin')->user()->id)->update([
                             'image' => $fileName

                    ]);

                }

                   Admin::where('id',Auth::guard('admin')->user()->id)->update([
                       'name' => $data['admin_name'],
                       'mobile' => $data['admin_mobile'],
                    ]);


                   Session::flash('success_message','Admin Details has been Updated Successfully ');
                   return redirect()->back();
            }
        } catch (\Throwable $th) {
            throw $th;
           // DB::rollback();

        }

        return view('admin.updata_admin_details',compact('admindetails'));
    }


}

                   //upload image
                //    if($request->hasFile('admin_image')){
                //         $image_tmp = $request ->file('admin_image');
                //        if($image_tmp->isValid()){
                //            //Get image Extensions
                //            $extension = $image_tmp->getClientOriginalExtension();
                //            // generate new image name
                //            $imageName = rand(111,99999).'.'.$extension;
                //            $imagePath = 'images/admin_images/admin_photos/'.$imageName;
                //            // upload image
                //            Image::make($image_tmp)->save($imagePath);
                //        }else if(!empty($data['current_admin_image'])){
                //             $imagePath = $data['current_admin_image'];
                //        }else {
                //            $imagePath = "";
                //        }
                //        Admin::where('id',Auth::guard('admin')->user()->id)->update(['image' => $imagePath
                //     ]);
                //    }
                //

// public function updateAdminDetails(Request $request){
    //     $admindetails = Admin::where('email',Auth::guard('admin')->user()->email)->first();
    //     try {
    //         if($request ->isMethod('post')){
    //             $data = $request->all();
    //             //echo "<pre>" ; print_r ($data) ;

    //             $rules =[
    //                 'admin_name' => 'required|alpha',
    //                 'admin_mobile' => 'required|numeric',
    //                 //'admin_image' => 'image',
    //                ];
    //                $messages =[
    //                 'admin_name.required' => ' Name is Required',
    //                 'admin_name.alpha' => 'Valid Name is Required',
    //                 'admin_mobile.required' => ' Mobile is Required',
    //                 'admin_mobile.numeric' => 'Valid Mobile is Required',
    //                 //'admin_image.image' => 'Valid Image is Required',
    //                ];
    //                $this->validate($request,$rules,$messages);
    //                //upload image Shabaan way
    //                if($request->hasFile('admin_image')){
    //                 $image_tmp = $request ->file('admin_image');
    //                if($image_tmp->isValid()){
    //                    //Get image Extensions
    //                    $extension = $image_tmp->getClientOriginalExtension();
    //                    // generate new image name
    //                    $imageName = rand(111,99999).'.'.$extension;
    //                    $imagePath = 'images/admin_images/admin_photos/'.$imageName;
    //                    // upload image
    //                    Image::make($image_tmp)->save($imagePath);
    //                }else if(!empty($data['current_admin_image'])){
    //                     $imagePath = $data['current_admin_image'];
    //                }else {
    //                    $imagePath = "";
    //                }
    //                Admin::where('id',Auth::guard('admin')->user()->id)->update(['image' => $imagePath
    //             ]);
    //            }

    //                //upload image Etsh way
    //             //    if($request->hasFile('admin_image')){
    //             //         $image_tmp = $request ->file('admin_image');
    //             //        if($image_tmp->isValid()){
    //             //            //Get image Extensions
    //             //            $extension = $image_tmp->getClientOriginalExtension();
    //             //            // generate new image name
    //             //            $imageName = rand(111,99999).'.'.$extension;
    //             //            $imagePath = 'images/admin_images/admin_photos'.$imageName;
    //             //            // upload image
    //             //            Image::make($image_tmp)->save($imagePath);
    //             //        }else if(!empty($data['current_admin_image'])){
    //             //             $imageName = $data['current_admin_image'];
    //             //        }else {
    //             //             $imageName = "";
    //             //        }
    //             //        Admin::where('id',Auth::guard('admin')->user()->id->update(['image' => $imageName
    //             //     ]));
    //             //    }

    //             //Emam Way
    //             // if ($request->has('admin_image')) {
    //             //     $filePath = uploadImage('admin', $request->admin_image);
    //             //     Admin::where('id', Auth::guard('admin')->user()->id)
    //             //         ->update([
    //             //             'admin_image' => $filePath,
    //             //         ]);
    //             // }

    //                Admin::where('id',Auth::guard('admin')->user()->id)->update([
    //                    'name' => $data['admin_name'],
    //                    'mobile' => $data['admin_mobile'],

    //                ]);
    //                Session::flash('success_message','Admin Details has been Updated Successfully ');
    //                return redirect()->back();
    //         }
    //     } catch (\Throwable $th) {
    //         return $th;
    //     }

    //     return view('admin.updata_admin_details',compact('admindetails'));
    // }
