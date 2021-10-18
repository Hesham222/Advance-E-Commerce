<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        try {
            $deleteProduct = Product::find($id);
            $deleteProduct->delete();
            $message = "Product has been deleted";

            Session::flash('success_message',$message);
            return redirect()->back();


        } catch (\Throwable $th) {
            return $th;
            Session::flash('error_message',"Product hasn't been deleted");
                 return redirect()->back();
        }
   }

   public function addEditProduct(Request $request,$id=null){

        if($id==""){
            $title = "Add product";
            $product = new Product;
            $message = "Product added Successfully";

        }else{
            $title = "Edit Product";
        }

        try {
            if($request -> isMethod('post')){
                $data = $request->all();

                $rules = [
                    'category_id'=>'required|',
                    'product_name'=>'required|string|max:100',
                    'product_code'=>'required|regex:/^[\w-]*$/',
                    'product_color'=>'required|',
                    'product_price'=>'required|numeric',

                ];
                $messages =[
                    'required' => 'This Field is Required',
                    'product_name.string' => 'Valid Product Name',
                    'product_code.regex' => 'Valid Product Code',
                    'product_price.numeric' => 'Valid Product Price',
                ];

                $this->validate($request,$rules,$messages);




                if(empty($data['is_featured'])){
                    $data['is_featured'] ="No";
                }else {
                    $data['is_featured'] ="Yes";
                }

                if(empty($data['description'])){
                    $data['description'] ="";
                }
                if(empty($data['meta_title'])){
                    $data['meta_title'] ="";
                }
                if(empty($data['meta_description'])){
                    $data['meta_description'] ="";
                }
                if(empty($data['meta_keywords'])){
                    $data['meta_keywords'] ="";
                }

                if(empty($data['product_video'])){
                    $data['product_video'] ="";
                }
                if(empty($data['fabric'])){
                    $data['fabric'] ="";
                }
                if(empty($data['pattern'])){
                    $data['pattern'] ="";
                }
                if(empty($data['sleeve'])){
                    $data['sleeve'] ="";
                }
                if(empty($data['occassion'])){
                    $data['occassion'] ="";
                }
                if(empty($data['fit'])){
                    $data['fit'] ="";
                }
                if(empty($data['wash_care'])){
                    $data['wash_care'] ="";
                }
                if(empty($data['product_discount'])){
                    $data['product_discount'] =0;
                }




                return $categoryDetails = Category::find($data['category_id']); //الكاتيجورى اي دي اللي جاي من الفورم
                $product->section_id = $categoryDetails['section_id'];
                $product->category_id = $data['category_id'];
                $product->product_name = $data['product_name'];
                $product->product_code = $data['product_code'];
                $product->product_color = $data['product_color'];
                $product->product_price = $data['product_price'];
                $product->product_discount = $data['product_discount'];
                $product->product_weight = $data['product_weight'];
                //$product->product_video = $data['product_video'];
                //$product->main_image = $data['main_image'];
                $product->description = $data['description'];
                $product->wash_care = $data['wash_care'];
                $product->fabric = $data['fabric'];
                $product->pattern = $data['pattern'];
                $product->sleeve = $data['sleeve'];
                $product->fit = $data['fit'];
                $product->occassion = $data['occassion'];
                $product->meta_title = $data['meta_title'];
                $product->meta_description = $data['meta_description'];
                $product->meta_keywords = $data['meta_keywords'];
                $product->is_featured = $data['is_featured'];
                $product->status = 1;
                $product ->save();

                Session::flash('success_message',$message);
                return redirect('admin/products');


            }
        } catch (\Throwable $th) {
            throw $th;
           // return $th;
            Session::flash('error_message','Product has not been added ');
            return redirect()->back();
        }

        $fabricArray = array('Cotton','Polyester','Wool');
        $sleeveArray = array('Full Sleeve','Half Sleeve','Short Sleeve');
        $patternArray = array('Checked','Plain','Printed','Self','Solid');
        $fitArray = array('Regular','Slim');
        $occassionArray = array('Casual','Formal');

        $categories = Section::with('categories')->get();

        return view('admin.products.add_edit_product',compact('title','fabricArray','sleeveArray','patternArray',
        'fitArray','occassionArray','categories'));
   }
}
