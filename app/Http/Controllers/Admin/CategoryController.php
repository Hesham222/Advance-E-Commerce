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
        $categories = Category::get();
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
        }else {
            $title = "Edit Category";
            //Edit Category functionality
        }
        //Get Section
        $getSections = Section::get();
        return view('admin.categories.add_edit_category',compact('title','getSections'));
    }
}
