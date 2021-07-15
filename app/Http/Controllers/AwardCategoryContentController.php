<?php

namespace App\Http\Controllers;

use App\Accessory;
use App\AwardCategoryContent;
use App\AwardCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

class AwardCategoryContentController extends Controller
{
    public function create()
    {
        $awardcategoryid = request('awardCategory');
        $accessories = Accessory::select('id','name')->get();
        $products = Product::select('id', 'item_name')->get();
        $awardcategories = AwardCategory::where('id',$awardcategoryid)->select('id','name')->first();
        return view('award.create_award_content')
            ->with( 'products', $products)
            ->with('awardcategories', $awardcategories)
            ->with('accessories', $accessories);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'award_type_id' => 'required',
            'quantity' => 'required',
            'visibility'=>'required',
            'product_id'=>'required',
            'award_category_id' => 'required|exists:award_categories,id'
        ]);
        AwardCategoryContent::create([
            'product_id'=>request('product_id'),
            'quantity'=>request('quantity'),
            'good_type'=>request('award_type_id'),
            'award_category_id'=>request('award_category_id'),
            'visible'=>request('visibility'),

        ]);

        return redirect()->back()
            ->with('flash_success', "Your Category Content was Successfully created");
    }

    public function show()
    {

        if($id = request('awardcategory'))
        {
            $awardcategory=AwardCategory::where('id', $id)->first();
        }
//        else{
//            $awardcategory = AwardCategory::all();
//        }

        return view('award.categorycontent', [
            'awardcategory'=>$awardcategory
        ]);
    }

    public function edit($award_content_id)
    {
        $awardcategorycontent = AwardCategoryContent::where('id',$award_content_id)->first();
        $accessories = Accessory::select('id','name')->get();
        $products = Product::select('id', 'item_name')->get();
        $awardcategories = AwardCategory::select('id','name')->get();
        return view('award.edit_award_content',[
            'awardcategorycontent'=>$awardcategorycontent,
            'products' => $products,
            'awardcategories' => $awardcategories,
            'accessories' => $accessories
        ]);
    }

    public function update($award_content_id, Request $request)
    {
        $this->validate($request, [
            'award_type_id' => 'required',
            'quantity' => 'required',
            'visibility'=>'required',
            'product_id'=>'required',
            'award_category_id' => 'required|exists:award_categories,id'
        ]);

        AwardCategoryContent::where('id',$award_content_id)->update([
            'product_id'=>request('product_id'),
            'quantity'=>request('quantity'),
            'good_type'=>request('award_type_id'),
            'award_category_id'=>request('award_category_id'),
            'visible'=>request('visibility'),
        ]);

        $awardcategory = AwardCategoryContent::where('id',$award_content_id)->select('award_category_id')->first();

       // echo ($awardcategory->award_category_id);
        return redirect('/view/award/categories/contents?awardcategory='.$awardcategory->award_category_id)->with('flash_success', "Your Category content was Successfully Updated");;
    }

    public function destroy($award_content_id)
    {
        $awardcategory=AwardCategoryContent::where('id',$award_content_id)->select('award_category_id')->first();

        AwardCategoryContent::where('id',$award_content_id)->delete();
        return redirect('/view/award/categories/contents?awardcategory='.$awardcategory->award_category_id)->with('flash_success', "Your Category content was Successfully Deleted");
    }
}
