<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;



class FoodPortalOperationController extends Controller
{
    public function index()
    {		
		$results = DB::table("portal-management")->get();
    	return view('foodportal.index', ["results" => $results]);
    }

    public function addNewCountry(Request $request)
    {
		$result = DB::table('portal-management')->insert(
			['country_name' => $request->country, 'status' => 0]
		);
		
		if($result){
			$results = DB::table("portal-management")->get();
			return redirect("/food-portal-operation");
		}else{
			$results = DB::table("portal-management")->get();
			return redirect("/food-portal-operation");
		}
    }

	public function openPortal(Request $request)
	{
		DB::table("portal-management")->where('id', $request->id)->update(['status' => 1]);
		DB::table("portal-management-log")->insert(
			[
				'country_id' => $request->id, 
				'date_opened' => date('Y-m-d h:i:s'), 
				'date_closed' => null, 
				'opened_by' => Auth::user()->id, 
				'closed_by' => null
			]
		);

		return redirect("/food-portal-operation");
	}

	public function closePortal(Request $request)
	{
		DB::table("portal-management")->where('id', $request->id)->update(['status' => 0]);
		DB::table("portal-management-log")->insert(
			[
				'country_id' => $request->id, 
				'date_opened' => null, 
				'date_closed' => date('Y-m-d h:i:s'), 
				'opened_by' => null, 
				'closed_by' => Auth::user()->id
			]
		);
		
		return redirect("/food-portal-operation");
	}
}

