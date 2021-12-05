<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class BrandController extends Controller
{
    public function brands(){
        Session::put('page','brands');
        $brands = Brand::get();
        return view('admin.brands.brands',compact('brands'));
    }

    public function updateBrandStatus(Request $request){
        try {
            if($request->ajax()) {
                 $data = $request->all();
                //echo "<pre>" ; print_r ($data) ; die;
            // return $data;
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
            }
        } catch (\Throwable $th) {
            return $th;
        }

    }

    public function addEditBrands(Request $request,$id=null){

        if($id==""){
            $title = "Add Brand";
            $brand = new Brand;
            $message = "Brand added Successfully";

        }else{
            $title = "Edit Brand";
            $brand = Brand::find($id);
            $message = "Brand updated Successfully";
        }

        if($request->isMethod('post')){
            $data = $request->all();
        }
        $brands = Brand::select('id','name')->get();
        return view('');
    }
}
