<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function getProducts(Request $request)
    {
        // Display products based on user country
        $products = DB::table('product')->where('quantity', '>', 0)->where('country', $request->country)->get();

        return json_encode(['products' => $products]);
    }

    public function products($country = 'Ghana')
    {
        $json = json_decode(file_get_contents('https://feedthenations.org/api/all_products/' . $country), true);
        dd($json);
    }
}
