<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\blogPosts;
use App\blogCategories;

class blogController extends Controller
{
    //

    public function createCategory(Request $request){
        $category= new blogCategories;
        $category->cat_title=$request->category_name;
        $category->save();

    Session::flash('flash_success','you have  successfully');

        return redirect()->back();
    }
    public function viewCategory($id){
       $category=blogCategories::findorFail($id);
       return view('blogadmin.viewcategotry')->with(['category'=>$category]);
   }
   public function showUpdatePage($id){
    $post=blogPosts::findorFail($id); 
    return ('blogadmin.viewcategotry')->with(['post'=>$post]);
   }
   public function updateCategory(Request $request){
       $category=blogCategories::findorFail($request->category_id);

       $category->cat_title=$request->category_name;
       $category->save();
     Session::flash('flash_success','you have  successfully');

        return redirect()->back();

   }

   public function deleteCategory($id){
   $category =blogCategories::findorFail($id);
   $category->delete();
    Session::flash('flash_success','you have  successfully');

        return redirect()->back();
   }

   public function viewAllCategories(){
      $categories = blogCategories::all();

   }

   public function createPost(){

   }
   public function viewPost(){

   }
   public function updatePost(){

   }

   public function deletePost(){

   }

   public function viewAllPost(){

   }

}
