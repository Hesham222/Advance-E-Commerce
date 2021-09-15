<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    public function categories(){
        Session::put('page','categories');
        $categories = Category::with(['section','parentcategory'])->get();
        return view('admin.categories.categories',compact('categories'));
    }


    public function updateCategoryStatus(Request $request){
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
               Category::where('id',$data['category_id'])->update(['status'=>$status]);
               return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
            }
        } catch (\Throwable $th) {
            return $th;
        }

    }

    // public function createCategory(){
    //     return view('admin.categories.categories_create');
    // }

    // public function addCategory(Request $request){
    //     //return $request;
    //     try {
    //     Category::create([$request->except(['_token'])]);


    //     return redirect()->route('categories')->with(['success' => 'تم الحفظ بنجاح ']);

    //     }catch(\Throwable $th){
    //         return $th;

    //         return redirect()->route('categories')->with(['error' => 'هناك خطأ ما يرجي المحاوله فيما بعد ']);

    //     }
    // }

    public function addEditCategory(Request $request,$id=null){
        if ($id=="") {
           $title = "Add Category";
           //add category functionality
           $category = new Category;
           $categorydata = array();
           $getCategories = array();
        }else {
            $title = "Edit Category";
            //Edit Category functionality
            $categorydata = Category::find($id);
            $getCategories = Category::with('subcategories')->where(['section_id'=>$categorydata['section_id'],'parent_id'=>0,'status'=>1])->get();

        }
        try {
            if($request ->isMethod('post')){
                $data = $request ->all();
                //echo "<pre>" ; print_r ($data) ; die;
                $rules = [
                    'category_name' => 'required|string',
                    'section_id' => 'required',
                    'url' => 'required',
                    'category_image' => 'required|mimes:jpg,jpeg,png',
                   ];

                   $messages =[
                    'category_name.required' => ' Category Name is Required',
                    'admin_name.string' => 'Valid Category Name is Required',
                    'section_id.required' => ' Section is Required',
                    'url.required' => 'Category URl is Required',
                    'admin_image.required' => 'Valid Image is Required',
                   ];

                  $this->validate($request,$rules,$messages);


                if($request->hasFile('category_image')){
                         $fileExtension =$request -> category_image -> getClientOriginalExtension();
                         $fileName = time().'.'.$fileExtension;
                         $path = 'images/category_images';
                         $request -> category_image ->move($path,$fileName);
                        $category->category_image = $fileName;
                }

                $category->parent_id = $data['parent_id'];
                $category->section_id = $data['section_id'];
                $category->category_name = $data['category_name'];
                $category->category_discount = $data['category_discount'];
                $category->description = $data['description'];
                $category->url = $data['url'];
                $category->meta_title = $data['meta_title'];
                $category->meta_description = $data['meta_description'];
                $category->meta_keywords = $data['meta_keywords'];
                $category->status = 1;
                $category->save();

                Session::flash('success_message','Admin Details has been Updated Successfully ');
                return redirect('admin/categories');

            }
        } catch (\Throwable $th) {
            return $th;
            Session::flash('error_message','Your Current password is incorrect ');
            return redirect()->back();
        }


        //Get Section
        $getSections = Section::get();
        return view('admin.categories.add_edit_category',compact('title','getSections','categorydata','getCategories'));
    }


    public function appendCategorieslevel(Request $request){
        try {
            if($request->ajax()){
                $data = $request ->all();
               // echo "<pre>" ; print_r ($data) ; die;
               //return $data;
               $getCategories = Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
               $getCategories = json_decode(json_encode($getCategories),true);
            //    echo "<pre>" ; print_r ($getCategories) ; die;
            return view('admin.categories.append_categories_level',compact('getCategories'));
            }
        } catch (\Throwable $th) {
            return $th;
        }

    }
}
