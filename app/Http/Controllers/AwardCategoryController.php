<?php

namespace App\Http\Controllers;

use App\AwardCategory;
use App\AwardType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AwardCategoryController extends Controller
{
    public function create()
    {
        $awardtypes = AwardType::select('id', 'name')->get();
        return view('award.create_award')
            ->with('awardtypes',$awardtypes);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'name' => 'required',
            'month_duration'=>'required',
            'stage'=>'required',
            'award_type_id' => 'required|exists:award_types,id'
        ]);
        AwardCategory::create([
            'award_type_id'=>request('award_type_id'),
            'name'=>request('name'),
            'description'=>request('description'),
            'month_duration'=>request('month_duration'),
            'stage'=>request('stage'),

        ]);

        return redirect()->back()
            ->with('flash_success', "Your Category was Successfully created");
    }

    public function show()
    {
        $awardcategories = AwardCategory::all();
        return view('award.category')->with('awardcategories',$awardcategories);
    }

    public function edit($award_id)
    {
        $awardCategory = AwardCategory::where('id',$award_id)->first();
        $awardtypes = AwardType::select('id', 'name')->get();
        return view('award.categoryedit')->with('awardCategory', $awardCategory)
            ->with('awardtypes',$awardtypes);
    }

    public function update($award_id, Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'name' => 'required',
            'month_duration'=>'required',
            'stage'=>'required',
            'award_type_id' => 'required|exists:award_types,id'
        ]);

        AwardCategory::where('id',$award_id)->update([
            'award_type_id'=>request('award_type_id'),
            'name'=>request('name'),
            'description'=>request('description'),
            'month_duration'=>request('month_duration'),
            'stage'=>request('stage'),
        ]);

        return redirect('/view/award/categories')->with('flash_success', "Your Category was Successfully Updated");
    }

    public function destroy($award_id)
    {
        $test = AwardCategory::where('id',$award_id)->first();
        foreach ($test->awardcategorycontents as $cc){
            $cc->delete();
        };

        $test->delete();

        return redirect('/view/award/categories')->with('flash_success', "Your Category was Successfully Deleted");
    }
}
