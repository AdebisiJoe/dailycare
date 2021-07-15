<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\product;
use App\User;
use App\Shoppingcart;
use App\cart;
use App\wishlist;

use Illuminate\Support\Facades\Auth;

class Shopcontroller extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }


  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: Edit
  * Purpose: For Multinational store
  * Description: Called function getUserCountry() on line 37 to initialize/call user country
  */
  public function showshop()
  {
    // Initialize user country
    self::getUserCountry();
    $categories = self::getAllCategory();
    $subcategories = self::getAllSubCategory();
    $products = self::getAllProducts();
    $mywishlist = self::countWishlist(Auth::user()->id);
    $mycart = self::countCartItems(Auth::user()->id);
    $userCartInfo = self::getUserCartInfo(Auth::user()->id);

    return view('shop.shop')->with('categories', $categories)->with('subcategories', $subcategories)->with('products', $products)->with('mycart', $mycart)->with('mywishlist', $mywishlist)->with('userCartInfo', $userCartInfo);
  }

  public function viewproductdetail($productName)
  {
    $productDetail = self::getProductBySlug($productName);
    $categories = self::getAllCategory();
    $subcategories = self::getAllSubCategory();
    $products = self::getAllProducts();
    $mywishlist = self::countWishlist(Auth::user()->id);
    $mycart = self::countCartItems(Auth::user()->id);
    $userCartInfo = self::getUserCartInfo(Auth::user()->id);


  return view('shop.product-details')->with('categories', $categories)->with('subcategories', $subcategories)->with('products', $products)->with('mycart', $mycart)->with('mywishlist', $mywishlist)->with('productDetail', $productDetail)->with('userCartInfo', $userCartInfo);
}

public function viewshopbasedoncategory($catid)
{
  $details = DB::table('products')->get();
}

public function viewshopbasedonsubcategory($subcategory)
{
    $userCartInfo = self::getUserCartInfo(Auth::user()->id);
    $categories = self::getAllCategory();
    $subcategories = self::getAllSubCategory();
    $mywishlist = self::countWishlist(Auth::user()->id);
    $mycart = self::countCartItems(Auth::user()->id);
    $products = self::getProductsBySubCategorySlug($subcategory);

    return view('shop.shop')->with('categories', $categories)->with('subcategories', $subcategories)->with('products', $products)->with('mycart', $mycart)->with('mywishlist', $mywishlist)->with('userCartInfo', $userCartInfo);
}

public function getdetails(Request $request, $id)
{
  $cart = new cart;
  $product = product::find($id);

  $session_id = Session::getId();

  $customerid = Auth::user()->id;
  $product_id = $id;
  $quantity = 1;
  $todaysdate = new \DateTime();
  $date = $todaysdate->format('Y-m-d');

}

public function getaddtocart(Request $request, $id)
{

  $cart = new cart;
  $product = product::find($id);

  $session_id = Session::getId();

  $customerid = Auth::user()->id;
  $product_id = $id;
  $post = $request->all();

  $quantity = $post['pqty'];
  $todaysdate = new \DateTime();
  $date = $todaysdate->format('Y-m-d');

  $total = DB::table('cart')
  ->where('customer_id', '=', $customerid)
  ->where('product_id', '=', $id)
  ->count();

  if ($total > 0) {
    DB::table('cart')
    ->where('customer_id', '=', $customerid)
    ->where('product_id', '=', $id)
    ->increment('quantity', $quantity);


    $results = DB::table('cart')
    ->where('customer_id', '=', $customerid)
    ->sum('quantity');

    return response()->json(["cart" => $results]);

  } else {
    $cart->customer_id = $customerid;
    $cart->session_id = $session_id;
    $cart->product_id = $id;
    $cart->quantity = $quantity;
    $cart->date_added = $date;
    $cart->save();

    $results = DB::table('cart')
    ->where('customer_id', '=', $customerid)
    ->sum('quantity');

    return response()->json(["cart" => $results]);
  }

  //return redirect()->intended('/shop');
}


public function getCart()
{

  $customerid = Auth::user()->id;

  $infoFromCart = self::getProductsFromCart($customerid);
  
  $cartproducts = self::getProductsFromCart($customerid);

  $total = DB::table('cart')
  ->where('customer_id', '=', $customerid)
  ->sum('quantity');

  return view('shop.cart', ['cartproducts' => $cartproducts, 'total' => $total, 'infoFromCart' => $infoFromCart]);

}

public function getCheckout()
{

  $customerid = Auth::user()->id;

  $infoFromCart = self::getProductsFromCart($customerid);
  
  $cartproducts = self::getProductsFromCart($customerid);

  $total = DB::table('cart')
  ->where('customer_id', '=', $customerid)
  ->sum('quantity');

  return view('shop.checkout', ['cartproducts' => $cartproducts, 'total' => $total, 'infoFromCart' => $infoFromCart]);

}

public function updateproductincart(Request $request, $id)
{

  $customerid = Auth::user()->id;
  $product_id = $id;
  $post = $request->all();

  $quantity = $post['pqty'];


  DB::table('cart')
  ->where('customer_id', '=', $customerid)
  ->where('product_id', '=', $id)
  ->update(['quantity' => $quantity]);


  $results = DB::table('cart')
  ->where('customer_id', '=', $customerid)
  ->sum('quantity');

  return response()->json(["cart" => $results]);

}

public function removefromcart(Request $request, $id)
{

  $customerid = Auth::user()->id;
  $product_id = $id;
  $post = $request->all();

  $quantity = $post['pqty'];


  DB::table('cart')
  ->where('customer_id', '=', $customerid)
  ->where('product_id', '=', $id)
  ->delete();


        //DB::table('users')->where('votes', '<', 100)->delete();
  $results = DB::table('cart')
  ->where('customer_id', '=', $customerid)
  ->sum('quantity');

  return response()->json(["cart" => $results]);

}

public function addtowhishlist(Request $request, $id)
{
        //$product=product::find($id);
  
  $wishlist = new wishlist;

  $customerid = Auth::user()->id;
  $product_id = $id;

  $todaysdate = new \DateTime();
  $date = $todaysdate->format('Y-m-d');


  $total = DB::table('wishlist')
  ->where('customer_id', '=', $customerid)
  ->where('product_id', '=', $id)
  ->count();

  if ($total > 0) {

    $results = DB::table('wishlist')
    ->where('customer_id', '=', $customerid)
    ->count();


    return response()->json(["wishlist" => $results]);


  } else {

    $wishlist->customer_id = $customerid;
    $wishlist->product_id = $product_id;
    $wishlist->date_added = $date;
    $wishlist->save();

    $results = DB::table('wishlist')
    ->where('customer_id', '=', $customerid)
    ->count();

    return response()->json(["wishlist" => $results]);
  }


}


  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: Edit Function ViewWishList
  * Purpose: For Multinational store
  * Description: Loaded user's country on line 302 and filtered products by user's country on lines 305-308
  */
public function viewwishlist(Request $request)
{

$categories = self::getAllCategory(); 
$subcategories = self::getAllSubCategory();
$mywishlist = self::countWishlist(Auth::user()->id);
$mycart = self::countCartItems(Auth::user()->id);
$userCartInfo = self::getUserCartInfo(Auth::user()->id);
$yourwishlist = new wishlist;
$customerid = Auth::user()->id;
$uwishlist = DB::table('wishlist')
->where('customer_id', $customerid)
->count();
$wishlist = DB::table('wishlist')
->where('customer_id', $customerid)
->get();

// Load user country
$country = self::getUserCountry();

// Get Products based on user country
$products = DB::table('product')
->select('product.*')
->where('country', $country)
->get();

return view('shop.wishlist')->with('wishlist', $wishlist)->with('products',$products)->with('categories',$categories)->with('subcategories',$subcategories)->with('mywishlist', $mywishlist)->with('mycart', $mycart)->with('userCartInfo',$userCartInfo);
}

public function removefromwishlist(Request $request, $id)
{
        //$product=product::find($id);
  $wishlist = new wishlist;

  $customerid = Auth::user()->id;
  $product_id = $id;
//INSERT INTO `whishlist`(`id`, `customer_id`, `product_id`, `date_added`) VALUES ([value-1],[value-2],[value-3],[value-4])


  DB::table('wishlist')->where('product_id', '=', $id)->delete();

  $total = DB::table('wishlist')
  ->where('customer_id', '=', $customerid)
  ->count();

  return response()->json(["wishlist" => $total]);
}

public function returncatandsubcat()
{

}

public function insertproduct()
{

}

public function updateproductquantity()
{

}

public function setcurrency()
{

}

public function viewproduct()
{

}

public static function shortenString($string, $len = 150)
{
  // if (strlen($string) > $len) {
  //   $string = trim(substr($string, 0, $len));
  //   $string = substr($string, 0, strrpos($string, " ")) . "&hellip;";
  // } else {
  //   $string .= "&hellip;";
  // }
  // return $string;
}

public function viewproductbasedoncategory(Request $request, $id)
{


}



  //MY NEW METHODS CREATED AT 31-OCT-2016

  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: Edited getProductByID
  * Purpose: For Multinational store
  * Description: Loaded user's country on line 388 and get product based on user's country on line 390
  */
  public function getProductByID($productID)
  {
    // Load user country
    $country = self::getUserCountry();

    return DB::table('product')->where('country', $country)->where('id', $productID)->first();
  }

  public function getProductByName($productName)
  {
    return DB::table('table')->where('item_name','=', $productName)->first();
  }


  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: Edited getProductBySlug()
  * Purpose: For Multinational store
  * Description: Loaded user's country on line 410 and get product based on user's country on line 411
  */
  public function getProductBySlug($productName)
  {
    $unslugged_str = str_replace('-', ' ', $productName);

    $country = self::getUserCountry();
    return DB::table('product')->where('country', $country)->where('item_name','=', $unslugged_str)->first();
  }

  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: Edited getAllProducts()
  * Purpose: For Multinational store
  * Description: Loaded user's country on line 423 and get product based on user's country on line 424
  */
  public function getAllProducts()
  {
    $country = self::getUserCountry();
    return DB::table('product')->where('country', $country)->where('quantity', '>', 0)->get();
  }

  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: Edited getAllProductsByDate()
  * Purpose: For Multinational store
  * Description: Loaded user's country on line 436 and get product based on user's country on line 437
  */
  public function getAllProductsByDate()
  {
    $country = self::getUserCountry();
    return DB::table('product')->where('country', $country)->orderBy('todaysdate', 'desc')->get();
  }

  // public function getAllProductsByCategory($categoryId)
  // {
  //   return DB::table('product')->where('categoryid', $categoryId)->get();
  // }

  // public function getAllProductsBySubCategory($subcategoryId)
  // {
  //   return DB::table('product')->where('subcategoryid', $subcategoryId)->get();
  // }

  // public function getProductsByCategorySlug($productCategory)
  // {
  //   $unslugged_str = str_replace_array('-', ' ', $productCategory);

  //   return DB::table('table')->where('item_name','=', $unslugged_str)->first();
  // }


  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: Edited getProductsBySubCategorySlug()
  * Purpose: For Multinational store
  * Description: Loaded user's country on line 469 and get products based on user's country on line 470-475
  */
  public function getProductsBySubCategorySlug($prodSubCat)
  {
    $unslugged_str = str_replace('-', ' ', $prodSubCat);

    $country = self::getUserCountry();
    return DB::table('product')
    ->join('sub_categories', 'sub_categories.id', '=', 'product.subcategoryid')
    ->where('sub_categories.sub_catname','=', $unslugged_str)
    ->where('product.country', $country)
    ->select('product.*', 'sub_categories.sub_catname', 'sub_categories.cat_id')
    ->get();
  }


  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: Edited getProductByCategoryID()
  * Purpose: For Multinational store
  * Description: Loaded user's country on line 488 and get products based on user's country on line 489
  */
  public function getProductByCategoryID($categoryId)
  {
    $country = self::getUserCountry();
    return DB::table('product')->where('country', $country)->where('categoryid', $categoryId)->get();  
  }

  public function getAllCategory()
  {
    return DB::table('category')->get();
  }

  public function getAllSubCategory()
  {
    return DB::table('sub_categories')->get();
  }

  public function countWishlist($customerId)
  {
    return DB::table('wishlist')
    ->where('customer_id', '=', $customerId)
    ->count();
  }

  public function countCartItems($customerId)
  {
    return DB::table('cart')
    ->where('customer_id', '=', $customerId)
    ->sum('quantity');
  }

  public function getUserCartInfo($customerId)
  {
    return DB::table('cart')
    ->join('product', 'cart.product_id','=','product.id')
    ->where('customer_id', '=', $customerId)
    ->select('cart.product_id as pid', 'cart.quantity as qty', 'product.item_name as item_name', 'product.price as price', 'product.categoryid as categoryid', 'product.description', 'product.brand_name as model')
    ->get();
  }

  public function getProductsFromCart($customerId)
  {
    return DB::table('cart')
    ->where('customer_id', '=', $customerId)
    ->join('product', 'cart.product_id', '=', 'product.id')
    ->select('cart.product_id as pid', 'cart.quantity as quantity', 'product.item_name as item_name', 'product.price as price','product.image as image', 'product.categoryid as categoryid', 'product.description', 'product.brand_name as model')
    ->get();
  }



  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: New Function
  * Purpose: For Multinational store
  * Description: Added new function getUserCountry() to initialize/call user country or make user country Nigeria by default
  */
  public function getUserCountry()
  {
    $result = DB::table('member_table')->where('username', Auth::user()->username)->first();
    if(count($result) > 0){
      return $result->country;
    }else{
      return 'Nigeria';
    }
  }
}
