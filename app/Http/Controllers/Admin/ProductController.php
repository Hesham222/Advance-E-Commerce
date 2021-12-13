<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Brand;
use App\models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Products_Image;
use App\Models\Products_Attribute;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
   public function products(){
       Session::put('page','products');

        $products = Product::with(['category'=>function($query){

           $query->select('id','category_name');

        },'section'=>function($query){

        $query->select('id','name');},'brand'=>function($query){
            $query->select('id','name');
        }
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
        // Product::where('id',$id)->delete();
        // $message = "Product has been deleted";
        // Session::flash('success_message',$message);
        // return redirect()->back();

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
            $productdata = array();
            $message = "Product added Successfully";

        }else{
            $title = "Edit Product";
            $productdata = Product::find($id);
            $product = Product::find($id);
            $message = "Product Edited Successfully";

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

                if($request->hasFile('main_image')){
                    $fileExtension =$request -> main_image -> getClientOriginalExtension();
                    $fileName = time().'.'.$fileExtension;
                    $path = 'images/products_images';
                    $request -> main_image ->move($path,$fileName);
                   $product->main_image = $fileName;
                }

                if($request->hasFile('product_video')){
                    $fileExtension =$request ->product_video -> getClientOriginalExtension();
                    $fileName = time().'.'.$fileExtension;
                    $path = 'videos/product_videos';
                    $request -> product_video ->move($path,$fileName);
                   $product->product_video = $fileName;
                }

                // if ($request ->hasFile('product_video')) {
                //     $video_tmp = $request->file('product_video');
                //     if($video_tmp->isVAlid()){
                //         $video_name = $video_tmp -> getClientOriginalName();
                //         $extension = $video_tmp -> getClientOriginalExtension();
                //         $videoName = $video_name.'-'.rand().'.'.$extension;
                //         $video_path = 'videos/product_videos';
                //         $video_tmp ->move($video_path,$videoName);
                //         $product->product_video = $videoName;
                //     }
                // }



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
                if(empty($data['product_weight'])){
                    $data['product_weight'] =0;
                }




                $categoryDetails = Category::find($data['category_id']); //الكاتيجورى اي دي اللي جاي من الفورم
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
                $product->brand_id = $data['brand_id'];
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

        $categories = Section::where('status',1)->with('categories')->get();
        $brands = Brand::where('status',1)->get();

        return view('admin.products.add_edit_product',compact('title','fabricArray','sleeveArray','patternArray',
        'fitArray','occassionArray','categories','productdata','brands'));
   }

   public function deleteProductIamge($id){
        try {
            //get product image
            $productImage = Product::select('main_image')->find($id);
            //get product path
            $image_path = 'images/products_images/';

            //delete product image from product images foldder if exists

            if(file_exists($image_path.$productImage->main_image)){
            unlink($image_path.$productImage->main_image);
            }

            //delete product image from categories table
            Product::where('id',$id)->update(['main_image'=>'']);

            $message = "Product Image has been deleted";
            Session::flash('success_message',$message);
            return redirect()->back();


            } catch (\Throwable $th) {
            //return $th;
            Session::flash('error_message',"Product Image hasn't been deleted");
            return redirect()->back();
            }
   }

   public function deleteProductVideo($id){
    try {
        //get product image
        $productvideo = Product::select('product_video')->find($id);
        //get product path
        $video_path = 'videos/product_videos/';

        //delete product video from product videos foldder if exists

        if(file_exists($video_path.$productvideo->product_video)){
        unlink($video_path.$productvideo->product_video);
        }

        //delete product video from categories table
        Product::where('id',$id)->update(['product_video'=>'']);

        $message = "Product video has been deleted";
        Session::flash('success_message',$message);
        return redirect()->back();


        } catch (\Throwable $th) {
        //return $th;
        Session::flash('error_message',"Product video hasn't been deleted");
        return redirect()->back();
        }
}

    public function addAttributes(Request $request,$id){

        try {
            if($request->isMethod('post')){
                 $data = $request->all();
                 //print_r($data);die;
                foreach ($data['sku'] as $key => $value) {
                    if(!empty($value)){

                        $attrCountSKU = Products_Attribute::where('sku',$value)->count();
                        if ($attrCountSKU>0) {
                            Session::flash('error_message','Sku is aready exist ');
                            return redirect()->back();
                        }
                        //$id ده بتاع البروداكت
                        $attrCountSize = Products_Attribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                        if ($attrCountSize>0) {
                            Session::flash('error_message','Size is aready exist ');
                            return redirect()->back();
                        }
                        $attribute = new Products_Attribute;
                        $attribute->product_id = $data['product_id'];
                        $attribute->sku =$value;
                        $attribute->size = $data['size'][$key];
                        $attribute->stock = $data['stock'][$key];
                        $attribute->price = $data['price'][$key];
                        //status ببعتها ديفولت بواحد عشان كل مااعمل اترر جديده تتعمل اكتف لوحديها
                        $attribute->status =1;
                        $attribute->save();
                    }

                }

                Session::flash('success_message','Product Attributes added Sucessfully');
                return redirect()->back();
            }
            //اول حاجه وانا بضيف او اي حاجه بكتب الكود اللي هجيب بيه حاجه عايزها تظهر
             $productdata = Product::with('attributes')->find($id);
            $title = "Products Attributes";
            return view('admin.products.add_attributes',compact('productdata','title'));

        } catch (\Throwable $th) {
           // throw $th;
            //return $th;
            Session::flash('error_message','Product Attributes Not added ');
            return redirect()->back();
        }

    }

    public function editAttributes(Request $request,$id){
        try {

            if($request->isMethod('post')){
                 $data = $request->all();
                 //بلف ع اي حاجه ف الارراي
                 foreach ($data['price'] as $key => $attr) {
                    if(!empty($attr)){
                        Products_Attribute::where(['id'=>$data['attrId'][$key]])->update([
                            'price' =>$data['price'][$key],
                            'stock' =>$data['stock'][$key],
                        ]);
                    }
                }
                $message = "Product Attributes Edited";
                Session::flash('success_message',$message);
                return redirect()->back();
            }


        } catch (\Throwable $th) {
            throw $th;
            Session::flash('error_message',"Product Attributes Not Edited");
            return redirect()->back();
        }
    }

    public function updateAttributeStatus(Request $request){
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
            Products_Attribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
            }
        } catch (\Throwable $th) {
            return $th;
        }

    }
    public function deleteAttribute($id){
        try {
            $attr = Products_Attribute::find($id);
            $attr->delete();
            $message = "Product Attribute has been deleted";

            Session::flash('success_message',$message);
            return redirect()->back();


        } catch (\Throwable $th) {
            return $th;
            Session::flash('error_message',"Product Attribute hasn't been deleted");
                 return redirect()->back();
        }

    }

    public function addImages(Request $request,$id){
        try {
            if($request->isMethod('post')){
                 $data = $request->all();
                //  echo "<pre>"; print_r($data);

                if($request->hasFile('image')){
                    //echo "test";die;
                    $images = $request->file('image');
                    foreach ($images as $key => $image) {
                        $productImage = new Products_Image;
                        $fileExtension =$image -> getClientOriginalExtension();
                        $fileName = time().'.'.$fileExtension;
                        $path = 'images/products_images';
                        $image ->move($path,$fileName);
                        $productImage->image = $fileName;
                        $productImage->product_id = $id;
                        $productImage->status = 1;
                        $productImage -> save();

                    }

                    Session::flash('success_message','produc images has been added');
                    return redirect()->back();

                }

            }


           $productdata = Product::select('id','product_name','product_color','product_code','main_image')->with('images')->find($id);
           // echo "<pre>"; print_r( $productdata);
           $title = "Products Images";
           return view('admin.products.add_images',compact('productdata','title'));

        } catch (\Throwable $th) {
           // throw $th;
           Session::flash('error_message','produc images has not been added');
           return redirect()->back();
        }
    }

    public function updateImageStatus(Request $request){

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
            Products_Image::where('id',$data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'image_id'=>$data['image_id']]);
            }
        } catch (\Throwable $th) {
            return $th;
        }

    }
    public function deleteImage($id){
        try{

            //get product image
            $productImage = Products_Image::select('image')->find($id);
            //get product path
            $image_path = 'images/products_images/';

            //delete product image from product images foldder if exists

            if(file_exists($image_path.$productImage->image)){
            unlink($image_path.$productImage->image);
            }

            //delete product image from categories table
            Products_Image::where('id',$id)->delete();

            $message = "Product Image has been deleted";
            Session::flash('success_message',$message);
            return redirect()->back();

        }catch(\Throwable $th) {
            throw $th;
        }
    }



}
