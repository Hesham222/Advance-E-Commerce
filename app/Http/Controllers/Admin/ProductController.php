<?php

namespace App\Http\Controllers\Admin;

use App\models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class ProductController extends Controller
{
   public function products(){
       Session::put('page','products');
        $products = Product::with(['category'=>function($query){
           $query->select('id','category_name');
        },'section'=>function($query){
        $query->select('id','name');}
        ])->get();
       return view('admin.products.products',compact('products'));
   }

   public function updateProductStatus(Request $request){
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
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
            }
        } catch (\Throwable $th) {
            return $th;
        }
   }

   public function deleteProduct($id){
        Product::where('id',$id)->delete();
        $message = "Product has been deleted";
        Session::flash('success_message',$message);
        return redirect()->back();
   }

   public function addEditProduct(Request $request,$id=null){

    if($id==0){
        $title = "Add product";
    }else{
        $title = "Edit Product";
    }
    if($request->isMethod('post')){

    }

    return view('admin.products.add_edit_product',compact('title'));
   }
}
