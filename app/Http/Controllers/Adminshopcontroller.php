<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Members;
use App\Totalreg;
use App\User;
use App\Item;
use App\Mlmlevel;
use App\Mlmrecords;
use App\category;
use App\subcategories;
use App\product;
use App\productdescription;
use Storage;


class Adminshopcontroller extends Controller
{
    
  public function __construct() {
    $this->middleware('auth');
}

    //admin functions
//product functions    




public function viewcategory(){

    $category=DB::table('category')
    ->select('id','cat_name')
    ->get();

    $subcategory=DB::table('sub_categories')
    ->join('category', 'sub_categories.cat_id', '=', 'category.id')
    ->select('sub_categories.id as id','sub_categories.cat_id','sub_categories.sub_catname','category.id as catid','category.cat_name')
    ->get();
    

    return view('shopadmin.category')->with('category', $category)->with('subcategory', $subcategory);
}

public function viewinsertcategory(){
    $category=DB::table('category')
    ->select('id','cat_name')
    ->get();
    return view('shopadmin.insertcategory')->with('category', $category);
}

public function insertcategory(Request $request){
    $category = new category;
    $subcategories = new subcategories;
    $todaysdate = date("Y-m-d");

    $category->cat_name = $request->categoryname;
    $category->description = nl2br($request->categorydescription);
    $category->meta_tag_title = $request->category_meta_title;
    $category->meta_tag_description = $request->category_meta_description;
    $category->meta_tag_keywords = $request->category_meta_keyword;
    $category->date_added= $todaysdate;
    $category->save();      

    //Added by MEshManuel @ 29/10/16

    Session::flash('flash_success','Last Operation was successful');
    
    return redirect('/adminshop');
}

public function updatecategory(Request $request)
{
    //Needs to be validated
 DB::table('category')
 ->where('id', $request->id)
 ->update(['cat_name' =>$request->categoryname,'description'=>$request->categorydescription,'meta_tag_title'=>$request->category_meta_title,'meta_tag_description'=>$request->category_meta_description,'meta_tag_keywords'=>$request->category_meta_keyword]);

 Session::flash('flash_success','Last Operation was successful');
 
 return redirect('/adminshop');
}

public function deletecategory($id){
    DB::table('category')->where('id', '=', $id)->delete();

    Session::flash('flash_success','Last Operation was successful');
    
    return redirect('/adminshop');
}

public function insertsubcategory(Request $request){

    $subcategory = new subcategories;

    $todaysdate = date("Y-m-d");
    
    $subcategory->cat_id = $request->categoryID;
    $subcategory->sub_catname = $request->subcategoryname;
    $subcategory->description = nl2br($request->subcategorydescription);
    $subcategory->meta_tag_title = $request->subcategory_meta_title;
    $subcategory->meta_tag_description = $request->subcategory_meta_description;
    $subcategory->meta_tag_keywords = $request->subcategory_meta_keyword;
    // $subcategory->date_added= $todaysdate;

    $subcategory->save();  

    $routeURL = '/subcategories/' . $request->categoryID;

    Session::flash('flash_success','Last Operation was successful');

    return redirect($routeURL);   
}

public function updatesubcategory(Request $request){

//  Update the change the foriegn key on both sub_categories and products tables
    DB::table('sub_categories')
    ->where('id', $request->subCategoryID)
    ->update(['cat_id' => $request->categoryID, 'sub_catname' =>$request->subcategoryname,'description'=>$request->subcategorydescription,'meta_tag_title'=>$request->subcategory_meta_title,'meta_tag_description'=>$request->subcategory_meta_description,'meta_tag_keywords'=>$request->subcategory_meta_keyword]);

    DB::table('product')
    ->where('subcategoryid', $request->subCategoryID)
    ->update(['categoryid' => $request->categoryID]); 

    $routeURL = '/subcategories/' . $request->categoryID;

    Session::flash('flash_success','Last Operation was successful');

    return redirect($routeURL);   
}

public function deletesubcategory(Request $request, $subCatID){
    DB::table('sub_categories')->where('id', '=', $subCatID)->delete();

    // Added @ 29-10-2016 MeshManuel
    Session::flash('flash_success','Last Operation was successful');

    return redirect()->back();
}


// product functions 
public function viewproduct(Request $request){
    $products = self::findallproducts(); 
    return view('shopadmin.product')->with('products',$products);
    // $category=DB::table('category')
    // ->select('id','cat_name')
    // ->get();

    // $subcategory=DB::table('sub_categories')
    // ->join('category', 'sub_categories.cat_id', '=', 'category.id')
    // ->select('sub_categories.id as id','sub_categories.cat_id','sub_categories.sub_catname','category.id as catid','category.cat_name')
    // ->get();

    // return view('shopadmin.insertproduct')->with('category', $category)->with('subcategory', $subcategory);
} 

public function createproduct()
{
    $category = DB::table('category')
    ->select('id','cat_name')
    ->get();

    $subcategory = DB::table('sub_categories')
    ->select('id', 'cat_id', 'sub_catname')
    ->get();

    return view('shopadmin.insertproduct')->with('category', $category)->with('subcategory', json_encode($subcategory));
}

/*
* Date: 29/09/2017
* Author: Mesh Manuel
* Activity: Edit
* Purpose: For Multinational store
* Description: Added country to product table on line 214
*/
public function insertproduct(Request $request){

    $this->validate($request, [
        'item_name' => 'required|unique:product',
        'quantity' => 'required|integer',
        'price' => 'required',
        'product_description' => 'required',
        ]);

    if($request->hasFile('product_image')){
        $file = $request->file('product_image');
        $fileName = time() . $file->getClientOriginalName();
        $file->move('images', $fileName);
    }

    $product = new product;
    $todaysdate = date("Y-m-d");
    
    $product->sku  = $request->sku;
    $product->item_name  = $request->item_name;
    $product->brand_name  = $request->brand_name;
    $product->quantity  = $request->quantity;
    $product->price  = $request->price;
    $product->image = $fileName;
    $product->description  = $request->product_description;
    $product->categoryid  = $request->categoryID;
    $product->subcategoryid = $request->subCategoryID;

    $product->dateadded = $todaysdate;
    $product->country = $request->country;
    $product->save();

    Session::flash('flash_success','Last Operation was successful');
    return redirect()->back(); 
    
}


/*
* Date: 29/09/2017
* Author: Mesh Manuel
* Activity: Edit
* Purpose: For Multinational store
* Description: Update country on product table on line 256
*/
public function updateproduct(Request $request){

    $this->validate($request, [
        'quantity' => 'required|integer',
        'price' => 'required|integer',
        'product_description' => 'required',
        ]);

    $fileName = "";

    if($request->hasFile('product_image')){
        $file = $request->file('product_image');
        $fileName = time() . $file->getClientOriginalName();
        $file->move('images', $fileName);
    }

    DB::table('product')
    ->where('id', $request->product_id)
    ->update([
        'item_name'=>$request->item_name,
        'brand_name' =>$request->brand_name,
        'quantity'=>$request->quantity,
        'price'=>$request->price,
        'categoryid'=>$request->categoryID,
        'subcategoryid'=>$request->subCategoryID,
        'description' =>$request->product_description,
        'country' => $request->country,
        'image' => $fileName
        ]);


    Session::flash('flash_success','Last Operation was successful');
    return redirect()->back();
}

public function deleteproduct($productID){
    
    DB::table('product')->where('id', '=', $productID)
    ->update([
        'quantity'=>0
        ]);

    Session::flash('flash_success','Last Operation was successful');

    return redirect()->back();
}






public function viewmanufacturer(){
    
}
public function insertmanufacturer(){

}
public function updatemanufacturer(){
    
}
public function deletemanufacturer(){
    
}

public function vieworder(){
    
}
public function insertorder(){
    
}
public function updateorder(){
    
}
public function deleteorder(){
    
}

public function viewvoucher(){
    
}
public function insertvoucher(){
    
}
public function updatevoucher(){
    
}
public function deletevoucher(){
    
}

//ADDED BY MeshManuel 28-10-2016

    //Find Subcategory by ID
public function findsubcategories($catID, $id){

    $subcategory=DB::table('sub_categories')
    ->where('id', $id)
    ->get();

    $products = self::findallproducts();

    return view('shopadmin.subcategory')->with('subcategory', $subcategory)->with('products', $products)->with('catID', $catID);
}

    //Get all the products from the database
public function findallproducts()
{

    return DB::table('product')
        // ->join('products_description', 'product.id', '=', 'products_description.productid')
        // ->select('product.*','products_description.weight','products_description.stock','products_description.image','products_description.description')
    ->get();
}

    //Get a particular product by its ID in edit mode
public function getaparticularproduct($id){

    $product = DB::table('product')
        // ->join('products_description', 'product.id', '=', 'products_description.productid')
        // ->select('product.*','products_description.weight','products_description.stock','products_description.image','products_description.description','products_description.meta_tag_title','products_description.meta_tag_keywords','products_description.meta_tag_description')
    ->where('product.id', $id)
    ->first();

    $category=DB::table('category')
    ->select('id','cat_name')
    ->get();

    $subcategory=DB::table('sub_categories')
    ->select('id', 'cat_id', 'sub_catname')
    ->get();

        //Get Category by ID
    $tmp_cat = DB::table('category')->where('id', $product->categoryid)->first();

        //Get SubCategory by ID
    $tmp_subcat = DB::table('sub_categories')->where('id', $product->subcategoryid)->first();

    return view('shopadmin.editproduct')->with('product', $product)->with('category', $category)->with('tmp_cat', $tmp_cat)->with('subcategory', json_encode($subcategory))->with('product_id', $id)->with('tmp_subcat', $tmp_subcat);
}

    //Get product by subcategory
public function findproductsbysubcategory($id){

    $subcategory=DB::table('product')
    ->where('subcategoryid', $id)
    ->get();

    $products = self::findallproducts();

    return view('shopadmin.subcategory')->with('subcategory', $subcategory)->with('products', $products);
}

    //Get all sub categories
public function getsubcategoriesByCatID($catID)
{
    $subcategory = DB::table('sub_categories')
    ->where('cat_id', $catID)
    ->get();
    $products = self::findallproducts();

    return view('shopadmin.subcategory')->with('subcategory', $subcategory)->with('products', $products)->with('catID', $catID);
}

    //Get Category by ID to edit
public function getcategoryeditview($catID)
{
    $category = DB::table('category')
    ->where('id', $catID)
    ->first();
    
    return view('shopadmin.editcategory')->with('category', $category);
}

    //29-10-206
    //Display the insert subcategory view
public function viewinsertsubcategory($catID)
{
    $categories = DB::table('category')
    ->get();
    
        //Get Category by ID
    $tmp_cat = DB::table('category')->where('id', $catID)->first();

    return view('shopadmin.insertsubcategory')->with('catID', $catID)->with('categories', $categories)->with('tmp_cat', $tmp_cat);
}

    //Get SubCategory by ID to edit
public function getsubcategoryeditview($catID, $subCatID)
{
    $subcategory = DB::table('sub_categories')
    ->where('id', $subCatID)
    ->first();

    $categories = DB::table('category')
    ->get();
    
        //Get Category by ID
    $tmp_cat = DB::table('category')->where('id', $catID)->first();


    return view('shopadmin.editsubcategory')->with('subcategory', $subcategory)->with('catID', $catID)->with('subCatID', $subCatID)->with('categories', $categories)->with('tmp_cat', $tmp_cat);
}

    //Get products by its subcategory ID
public function getproductbysubcategoryid($catID)
{
    $products = DB::table('product')
        // ->join('products_description', 'product.id', '=', 'products_description.productid')
        // ->select('product.*','products_description.weight','products_description.stock','products_description.image','products_description.description')
    ->where('product.subcategoryid', $catID)
    ->get();

    return view('shopadmin.product')->with('products', $products);
}

}
