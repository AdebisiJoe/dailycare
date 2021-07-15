<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Orders;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class OrdersController extends Controller
{
	private $orderAmount = '';

	//Check if user is logged in
	public function __construct() {
		$this->middleware('auth');
	}
	
	/**
	 * This method returns all the orders in the orders table.
	 */
	public function all()
	{
		return DB::table('mlm_orders')
					->where('deleted', 0)
					->orderBy('UpdatedAt', 'desc')
					->get();
	}

	/**
	 * This method returns all the orders in the orders table.
	 */
	public function allByID()
	{
		$orders = DB::table('mlm_orders')
					->where('deleted', 0)
					->where('CustomerID', Auth::user()->username)
					->orderBy('UpdatedAt', 'desc')
					->get();

		return view('orders.myorders', ['orders' => $orders]);	
	}

	/**
	 * This method returns an order from the orders table.
	 * @param int $id The orderID.
	 */
	public function find($id)
	{
		DB::table('mlm_orders')->where('ID', $id)->first();
	}

	/**
	 * This method returns an order from the orders table.
	 * @param int $id The orderID.
	 */
	public function findUserOrder(Request $request)
	{
		$products = [];
		$result = DB::table('mlm_orders')
					->where('ID', $request->id)
					->first();
		if($result){
			foreach (json_decode($result->ProductID) as $value) {
				array_push($products, $this->getProductByID($value)->item_name);
			}
			// //If User tries toi get in tru the URL redirect them to their home page
			// if ($result->transfered == 0 || $result->status == 1) {
			// 	return redirect()->intended('/my-orders');
			// }
			return view('orders.editorders', ['order' => $result, 'id' => $request->id, 'productList' => $products]);
		}else{
			return back();
		}
	}

	/**
	 * This method saves the order in the database.
	 * @param Request $request From the submitted form.
	 */
	public function store($request)
	{
		   
		$price = 0;

		for ($i = 0; $i < count($request->productAmt); $i++) {
			$a = $this->getPriceByID($request->productID[$i]);
			$b = $request->productQty[$i];
			$price += ((float)$a * (float)$b);
		}

	    //Create new order
		DB::table('mlm_orders')
			 ->insert(
			 	[
				    'ProductID' => json_encode($request->productID),
				    'CustomerID' => Auth::user()->username,
				    'ProductQty' => json_encode($request->productQty),
				    'ProductAmt' => json_encode($request->productAmt),
				    'OrderAmount' => $request->$price,
				    'shippingAdd' => json_encode($request->shippingAdd),
				    'CreatedBy' => Auth::user()->username,
				    'CreatedAt' => date('d-m-Y'),
				    'UpdatedBy' => Auth::user()->username,
				    'UpdatedAt' => date('d-m-Y')
			 	]
			);
	}

	
	/**
	 * This method deletes an from the orders table.
	 * @param int $id The OrderID.
	 */
	public function delete($id)
	{
		DB::table('mlm_orders')
			->where('ID', $id)
			->update(
					[
						'deleted' => 1
					]
				);
	}


	/**
	 * This method updates an order orders table.
	 * @param Request $request From the submitted form.
	 */
	public function update(Request $request)
	{
		DB::table('mlm_orders')
			 ->where('ID', $request->id)
			 ->update(
			 	[
				    'ProductID' => $request->id,
				    'CustomerID' => $request->id,
				    'ProductQty' => $request->id,
				    'ProductAmt' => $request->id,
				    'OrderAmount' => $request->id,
				    'CreatedBy' => $request->id,
				    'UpdatedBy' => $request->id,
			 	]
			);
	}

	/**
	 * This method updates the status of an order in the orders table.
	 * @param int $orderID 
	 * @param int $statusID
	 */
	public function updateStatus($orderID, $statusID)
	{
		DB::table('mlm_orders')
			 ->where('ID', $orderID)
			 ->update(
			 	[
			 		'status' => $statusID,
			 	]
			);
	}
	//Controller Actions

	/**
	 * This method displays all the orders in the orders table.
	 */
	public function getAllOrders()
	{
		$orders = self::all();
		return view('orders.index', ['orders' => $orders]);	
	}

	/**
	 * This method deletes an order in the orders table.
	 */
	public function deleteOrder($orderID)
	{
		self::delete($orderID);
		$orders = self::all();
		return view('orders.index', ['orders' => $orders]);	
	}

	/**
	 * This method deletes an order in the orders table.
	 */
	public function setUpdateStatus($orderID, $statusID)
	{
		self::updateStatus($orderID, $statusID);
		// self::getAllOrders();
		$orders = self::all();
		return view('orders.index', ['orders' => $orders]);	
	}

	/**
	 * This method deletes an order in the orders table.
	 */
	public function newOrder(Request $request)
	{
		//Validate Request from users
		$validator=Validator::make($request->all(),
			[
			    'productID' => 'required',
		        'productQty' => 'required',
		        'productAmt' => 'required',
		        'productAmount' => 'required',
		        'shippingAdd' => 'required',
			]);
        if ($validator->fails()){
			return redirect()
			->back()
			->withErrors($validator)
			->withInput();
		}
	    // self::setOrderAmount($request->productAmount);

	    //IF $request->productAmount != $foodCash Decline Order or DO NOT SAVE
		//Check if user is in stage 0
		$userstage = DB::table('member_table')->where('username', Auth::user()->username)->first()->stage;

		if($userstage == 0){
    		Session::flash('flash_danger','You can not make any purchase in stage 0');
			return redirect()->intended('/home');
		}

		self::store($request);

		$orders = self::all();
		$amountdeducted = $request->productAmount/200;
		$userid = (new UserController)->getuseridwithusername();

		DB::table('tempcurrentamount')
			->where('userid','=',$userid)
			->decrement('foodcash',$amountdeducted);

		//Clear the cart
		self::clearUserCart();
     Session::flash('flash_success','Order was placed successfully');
		return redirect()->intended('/my-orders');
	}


  public function checkbalance(Request $request){
   $post = $request->all();

  $totalamount = $post['totalamount'];

  $userid=(new UserController)->getuseridwithusername();
  $results=DB::table('tempcurrentamount')
		->where('userid','=',$userid)
		->get();
		foreach ($results as $key => $v) {
			# code...
			$foodcash=$v->foodcash;
		}
	$realtotalamount=$totalamount/200;
	$cashavailable=	$foodcash*200;
   if ($realtotalamount>$foodcash) {
   			# code...
   	 return response()->json(["cash" =>"insufficientcash","cashvalue" =>$totalamount,'cashavailable'=>$cashavailable]);

   		} else {
   			# code...
      return response()->json(["cash" =>"sufficientcash","cashvalue" =>$totalamount,'cashavailable'=>$cashavailable]);
   		}

	}

	private function clearUserCart()
	{
		$id=Auth::User()->id;
		DB::table('cart')
		->where('customer_id', $id)
		->delete();
	}

	public function updateOrder(Request $request)
	{
		$price = 0;

		for ($i = 0; $i < count($request->productItems); $i++) {
			$a = $this->getPriceByID($request->productItems[$i]);
			$b = $request->productQty[$i];
			$price += ((float)$a * (float)$b);
		}

		$foodcash = (float)$this->getFoodCash() * 200;

		//Get old order amount
		$oldAmount = (float)$this->getOrderAmount($request->orderID);

		if (($foodcash + $oldAmount) > $price) {

			//Subtract old from new amount
			$newPrice = $oldAmount - (float)$price;

			DB::table('mlm_orders')
				->where('ID', '=', $request->orderID)
				->update([
					    'ProductID' => json_encode($request->productItems),
					    'CustomerID' => Auth::user()->username,
					    'ProductQty' => json_encode($request->productQty),
					    'ProductAmt' => json_encode($request->productAmt),
					    'OrderAmount' => $price,
					    'UpdatedBy' => Auth::user()->username,
					    'UpdatedAt' => date('d-m-Y')
					]);

			if ($this->isNegetive($newPrice)) {
				$this->updateBalance(abs($newPrice), 'decrement');
			}else{
				$this->updateBalance(abs($newPrice), 'increment');
			}
		    Session::flash('flash_success','Order was updated successfully');
			return back();
		}else{
		    Session::flash('flash_danger','Order was cancelled. Not enough fund in foodcash');
			return back();
		}
	}

	private function getPriceByID($productID)
	{
		$result = DB::table('product')
						->select('price')
						->where('ID', $productID)
						->first();
		return $result->price;
	}

	private function getProductByID($productID)
	{
		$result = DB::table('product')
						->select('item_name','price')
						->where('ID', $productID)
						->first();
		return $result;
	}

	private function getOrderAmount($productID)
	{
		return DB::table('mlm_orders')->select('OrderAmount')->where('ID', $productID)->first()->OrderAmount;
	}

	public function cancelOrder(Request $request)
	{
		DB::table('mlm_orders')
			->where('ID', '=', $request->id)
			->update([
				    'status' => 1,
				    'UpdatedBy' => Auth::user()->username,
				    'UpdatedAt' => date('d-m-Y')
				]);

		$this->updateBalance($this->getOrderAmount($request->id), 'increment');
	    Session::flash('flash_success','Order was cancelled successfully');
		return back();
	}

	public function generateInvoice(Request $request)
	{
		$products = [];
		$result = DB::table('mlm_orders')
					->where('ID', $request->id)
					->first();
		$userInfo = DB::table('member_table')->where('username', $result->CustomerID)->first();
		if($result){
			foreach (json_decode($result->ProductID) as $value) {
				array_push($products, $this->getProductByID($value)->item_name);
			}
			
			//If User tries toi get in tru the URL redirect them to their home page
			if ($result->transfered == 0 || $result->status == 1) {
				Session::flash('flash_warning','Sorry, You can\'t this page');
				return redirect()->intended('/my-orders');
			}
			return view('orders.invoice', ['order' => $result, 'id' => $request->id, 'productList' => $products, 'userInfo' => $userInfo]);
		}
	}

	public function completeOrder(Request $request)
	{
		//If order is collected, reply {already collected} else {complete and reply colleted}
		$id = ltrim($request->id, 'FTN-00');

		$status = DB::table('mlm_orders')->where('ID', '=', $id)->first()->status;

		$transfered = DB::table('mlm_orders')->where('ID', '=', $id)->first()->transfered;

		if($status == 3){
			dd('Already Collected');
		}elseif ($status == 0 && $transfered != 0) {
			$result = DB::table('mlm_orders')
				->where('ID', '=', $id)
				->update([
					    'status' => 3,
					    'UpdatedBy' => Auth::user()->username
			]);
			if ($result) {
				dd('Transaction Completed');
			}else{
				dd('Something went wrong');
			}
		}elseif ($transfered == 0) {
			dd('You can\'t collect a transfered order');
		}elseif ($status == 1) {
			dd('You have already cancelled this order');
		}
	}

	public function transferOrder(Request $request)
	{ 	
		$validator=Validator::make($request->all(),
			[
			    'id' => 'required'
			]);
        if ($validator->fails()){
			return redirect()
			->back()
			->withErrors($validator)
			->withInput();
		}
		//Get Username from ID
		$membershipid = $request->id;
		$orderID = $request->orderID;
		$userid = DB::table('member_table')->select('username')->where('membershipid', $membershipid)->first()->username;

		$result = DB::insert('INSERT INTO mlm_orders (ProductID, CustomerID, ProductQty, ProductAmt, OrderAmount, shippingAdd, CreatedAt, CreatedBy, UpdatedAt, UpdatedBy, status, deleted, transfered, transfered_by, transfered_at)
		SELECT ProductID, ?, ProductQty, ProductAmt, OrderAmount, shippingAdd, CreatedAt, CreatedBy, UpdatedAt, UpdatedBy, ?, deleted, ?, ?, ?  FROM mlm_orders WHERE mlm_orders.ID = ? AND mlm_orders.CustomerID = ?', [$userid, 0, 1, Auth::user()->username,date('d-m-Y'), $orderID, Auth::user()->username]);
		
		DB::table('mlm_orders')->where('ID', $orderID)->update(['transfered' => 0, 'transfered_by' => Auth::user()->username, 'transfered_at' => date('d-m-Y')]);

     Session::flash('flash_success','Order has been transfered.');
		return redirect()->intended('/my-orders');
	}

	public function updateBalance($amount, $opp)
	{
		$membershipid = DB::table('member_table')->select('membershipid')->where('username', Auth::user()->username)->first()->membershipid;
		$amount = (float)$amount / 200.0;

		if($opp == 'increment')
			DB::table('tempcurrentamount')->where('userid', $membershipid)->increment('foodcash', $amount);
		else
			DB::table('tempcurrentamount')->where('userid', $membershipid)->decrement('foodcash', $amount);
	}

	private function isNegetive($value)
	{
		if ($value < 0) {
			return true;
		}else{
			return false;
		}
	}

	//New Added @ 7/12/16
	private function getFoodCash()
	{
		$membershipid = DB::table('member_table')->select('membershipid')->where('username', Auth::user()->username)->first()->membershipid;
		return DB::table('tempcurrentamount')->where('userid', $membershipid)->first()->foodcash;
	}

	public function countActiveOrders()
	{
		$result = DB::select('SELECT * FROM `mlm_orders` WHERE CustomerID = ? and status = 0 and (transfered = 2 or transfered = 1)', [Auth::user()->username]);
		return count($result);
	}

	//Newly Added @ 9/12/2016
	public function getOrderList(Request $request)
	{
        $searchdate[0] = $request->date_from;
        $searchdate[1] = $request->date_to;

        $result = DB::select('SELECT * FROM `mlm_orders` WHERE UpdatedAt BETWEEN ? AND ? AND status = 0 and (transfered = 2 or transfered = 1)', [$searchdate[0], $searchdate[1]]);
        dd($result);
		
	}

	public function getOrderByProduct(Request $request)
	{
        $searchdate[0] = $request->date_from;
        $searchdate[1] = $request->date_to;

        $result = DB::select('SELECT * FROM `mlm_orders` WHERE UpdatedAt BETWEEN ? AND ? AND status = 0 and (transfered = 2 or transfered = 1)', [$searchdate[0], $searchdate[1]])->ProductID;
        dd($result);
		
	}

	public function displayTransferOrderView(Request $request)
	{
		return view('orders.transfer-order')->with('orderID', $request->id);
	}
}
