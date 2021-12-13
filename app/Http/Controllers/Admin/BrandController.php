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

        try {

            if($id==""){
                $title = "Add Brand";
                $brand = new Brand;
                $branddata = array();
                $message = "Brand added Successfully";

            }else{
                $title = "Edit Brand";
                $branddata = Brand::find($id);
                $brand = Brand::find($id);
                $message = "Brand updated Successfully";
            }

            if($request->isMethod('post')){
                $data = $request->all();

                $rules = [
                    'brand'=>'required',
                ];
                $messages =[
                    'brand.required' => 'Brand Name Is required ',
                ];

                $this->validate($request,$rules,$messages);

                 $brand->name = $data['brand'];
                 $brand->status = 1;
                 $brand->save();

                 Session::flash('success_message',$message);
                 return redirect('admin/brands');
            }
        } catch (\Throwable $th) {
            Session::flash('error_message','Brand Not added ');
            return redirect()->back();
        }

        $brands = Brand::select('id','name')->get();
        return view('admin.brands.add_edit_brand',compact('title','brand','branddata'));
    }

    public function deletBrand($id){

        try {
            $deleteBrand = Brand::find($id);
            $deleteBrand->delete();
            $message = "Brand has been deleted";

            Session::flash('success_message',$message);
            return redirect()->back();


        } catch (\Throwable $th) {
            return $th;
            Session::flash('error_message',"Brand hasn't been deleted");
                 return redirect()->back();
        }
    }
}
