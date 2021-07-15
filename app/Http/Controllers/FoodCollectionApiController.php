<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\accountcontroller;
use App\Http\Controllers\FoodCollectionController;
use DB;
use Auth;
use Response;

class FoodCollectionApiController extends Controller
{

    private $foodCollectionController;

    function __construct(){
        $this->middleware('jwt.auth');
        $this->foodCollectionController = new FoodCollectionController();
    }

    /**
     * @return json Returns all the food collection groups
     */
    public function getGroups()
    {
        try{
            $groups = $this->foodCollectionController->getGroups();

            return Response::json([
                'data' => $groups
            ],200);

        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    /**
     * @return json Returns all products in the store.
     */
    public function getProducts()
    {
        try{
            $products = DB::table('product')->where('quantity','>', 0)->get();

            return Response::json([
                'data' => $products
            ],200);

        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    /**
     * @param $request Contains membershipid
     * @return json Returns the user's current balance both food cash and payout cash
     */
    public function getUserAccountBalance(Request $request)
    {
        try{
            $userAccountBalance = DB::table('tempcurrentamount')->where('userid', $request->membershipid)->get();

            return Response::json([
                'data' => $userAccountBalance
            ],200);

        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    /**
     * @param $request Contains membershipid
     * @return json Returns All SubAccount information
     */
    public function getSubAccountInformation(Request $request)
    {
        try{
            $subAccountInformation = $this->foodCollectionController->getSubAccountDetails($request->membershipid);

            return Response::json([
                'data' => $subAccountInformation
            ],200);

        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    /**
     * Handle submission of food items
     * ($buyer_id, $group_leader_id, $items, $qty)
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function submitFoodRequestForm(Request $request)
    {
        try{
            $result = $this->foodCollectionController->submitRequest($request);

            return Response::json([
                'data' => $result
            ],200);

        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getFoodCollectedHistory(Request $request)
    {
        try{
            $report = DB::select("SELECT m.date_created, product.item_name, m.quantity, m.amount FROM mlm_foodcollection m INNER JOIN product ON product.id = m.product_id WHERE m.user_id = '$request->membershipid' ORDER BY m.date_created DESC");

            return Response::json([
                'data' => $report
            ],200);

        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|string|\Symfony\Component\HttpFoundation\Response
     */
    public function getReports(Request $request)
    {
        try{
            $username = Auth::user()->username;
            $membershipid = DB::table('member_table')->where('username','=',$username)->first()->membershipid;

            $result = DB::table('mlm_groups')->whereNull('deleted_at')->where('owner_id', $membershipid)->first();

            if(!$result){
                $box_top = '<div>You are not a group leader.</div>';
                return $box_top;

            }else{

                $date_start = trim(explode('-', $request->date)[0]);
                $date_start = str_replace('/', '-', $date_start);

                $date_end = trim(explode('-', $request->date)[1]);
                $date_end = str_replace('/', '-', $date_end);

                if($request->report_id == 1){
                    $report = $this->foodCollectionController->getGroupLeaderList($date_start, $date_end, $result->id,'','');
                }else if($request->report_id == 2){
                    $report = $this->foodCollectionController->getAdminReport($date_start, $date_end, $result->id,'','');
                }else{

                }
            }
        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }

    public function getTotalOrders(Request $request)
    {
        try{
            $report = DB::table('mlm_foodcollection')->where('user_id', $request->membershipid)->count();
            return Response::json([
                'data' => $report
            ],200);

        }catch (\Exception $e)
        {
            return response('error',400);
        }
    }
}
