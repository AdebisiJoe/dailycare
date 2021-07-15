<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class FoodCollectionController extends Controller
{

    private $SYSTEM_RATE = 200;    
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('foodcollection.index');
    }


    /*
    * Date: 29/09/2017
    * Author: Mesh Manuel
    * Activity: Edited getProducts()
    * Purpose: For Multinational store
    * Description: 
        Line 39 - Make sure user has a country
        Line 48 - Display products to user based on his country
    */
    public function getProducts()
    {
        // Make sure user has a country
        $result = DB::table('member_table')->where('username', Auth::user()->username)->first();
        
        if(!count($result->country) > 0){
            return 'Please update your country.';
        }

        // Display products based on user country
        $products = DB::table('product')->where('quantity','>', 0)->where('country', $result->country)->get();

        $user_id = DB::table('member_table')->where('username', Auth::user()->username)->first()->membershipid;

        // Date: 26/11/2017
        // Return user country
        // Display user currency
        $user_country = DB::table('member_table')->where('username', Auth::user()->username)->first()->country;

        $account = DB::table('tempcurrentamount')->where('userid', $user_id)->first();
        $subaccounts = $this->getSubAccountDetails($user_id);
        $groups = $this->getGroups();
        return json_encode(['products' => $products, 'account' => $account, 'user_id' => $user_id, 'subaccounts' => $subaccounts, 'groups' => $groups, 'user_country' => $user_country]);
    }


  /*
  * Date: 29/09/2017
  * Author: Mesh Manuel
  * Activity: Edited getGroups()
  * Purpose: For Multinational store
  * Description: 
    Line 69 - Make sure user has a country
    Line 76 - Display groups to user based on his country
  */
    public function getGroups()
    {
        // Make sure user has a country enabled
        $result = DB::table('member_table')->where('username', Auth::user()->username)->first();

        if (Auth::user()->role != 'admin' && !count($result->country) > 0) {
            if (Auth::user()->role != 'shopadmin' && !count($result->country) > 0) {
                return 'Please update your country.';
            }
        }
// |
        // Display groups to user based on his country
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'shopadmin') {
            return DB::table('mlm_groups')->whereNull('deleted_at')->orderBy('group_name', 'asc')->get();
        }else{
            return DB::table('mlm_groups')->where('country', $result->country)->whereNull('deleted_at')->orderBy('group_name', 'asc')->get();
        }
    }

    public function submitRequest(Request $request)
    {
        if(Auth::user()->food_banned == 1){
            return json_encode("SORRY, You have been banned from ordering food please contact the office.");
        }


//         Close or Open Food Collection
         
        $user_id = $request->buyer_id;
        
        //  Get Customer IsOwnedBy
        $new_userid = DB::table("member_table")->where('membershipid', $user_id)->first()->isownedby;

        // Get Customer Country
        $country = DB::table("member_table")->where('membershipid', $new_userid)->first()->country;

        // Get all opened countries
        $country_status = DB::table("portal-management")->where('country_name', $country)->first()->status;
        
        // Check if Store is opened
        if ($country_status == 0){
            return json_encode("SORRY, Food collection is closed.");
        }else{
            
        

        
        //return json_encode("SORRY, Food collection is closed.");
        

        // Check If User is still in Stage Zero
        $user_stage = DB::table('member_table')->where('membershipid', $user_id)->first()->stage;

        if($user_stage == 0){
            return json_encode("SORRY, You can not order for any product in Stage 0.");
        }

        //Check If Group Leader Not Selected         
        // if($request->group_leader_id == -1){
        //     return json_encode("Please select a group or group leader.");
        // }

        $account = DB::table('tempcurrentamount')->where('userid', $user_id)->first();

        $date_created= date('Y-m-d');
        $product_id = $request->items;
        $quantity = $request->qty;

        // Change total amount from 0.0 to 1.0 as instructed by Mr. Joe in place of the monthly charge
        $total_amount = 1.0;
        $amount = [];
        
        
        
        //change the charge to once per month as discussed in the management meeting after charge was done fixed 14/8/2019 by joe
          $count = DB::table('mlm_foodcollection')
          ->where('user_id', $user_id)
          ->whereBetween('date_created', [date('01-m-Y'),date('d-m-Y')])
          ->count();
          
        if($count>=1){
          $total_amount=0;
        }

        // Check if SUM of Product ID is 0
        if(array_sum($product_id) == 0){
            return json_encode("Select a product.");
        }

        // Get Amount of each products
        for ($i=0; $i < count($product_id); $i++) { 

            if($product_id[$i] != 0){
                $product_price = DB::table('product')->where('id', $product_id[$i])->first()->price;
                $total_amount += $product_price * $quantity[$i];
            }

            //Store product prices in an array
            array_push($amount, ($product_price / $this->SYSTEM_RATE));
        }

        // Check if Amount is empty
        if(count($amount) == 0){
            return json_encode("Select a product.");
        }
        
        // Allow Users in Stage 1 with 54.4 as balance to Order for RICE and OIL
        if($user_stage == 1 && $account->foodcash == 54.4 && count($product_id) == 2 && in_array(12, $product_id) && in_array(17, $product_id)){
            // //Reset Quantity
            // $quantity = [1,1];

            // //Process Payment
            // $this->processPayment($total_amount, $account, $user_id, $product_id, $request, $date_created, $quantity, $amount);
            // return json_encode("true");
            
            return json_encode("You cannot select More than you have in your Account.");
        }


        $total_amount_in_wallet = (($account->foodcash + $account->payoutcash) * $this->SYSTEM_RATE);

        if($total_amount_in_wallet < ($total_amount / 200)){
            return json_encode("You cannot order food because you have insufficient balance your Account.");
        }



        // BEGIN TRANSACTION
        if ($total_amount <= (($account->foodcash + $account->payoutcash) * $this->SYSTEM_RATE)) {
        //if ($total_amount <= (($account->foodcash) * $this->SYSTEM_RATE)) {

            $this->processPayment($total_amount, $account, $user_id, $product_id, $request, $date_created, $quantity, $amount);
            
            return json_encode('true');     
        }else{
            return json_encode('false');
        }
        
        
        }
   
    }

    private function processPayment($total_amount, $account, $user_id, $product_id, $request, $date_created, $quantity, $amount)
    {

        DB::beginTransaction();

        try {

            //Convert Total Amount To The MLM System rate
            $order_amount_in_system_rate = $total_amount / $this->SYSTEM_RATE;
            //remove percentage
            //$percentageAmount=(1/100)*$order_amount_in_system_rate;
           // $order_amount_in_system_rate+=$percentageAmount;

            //Deduct Amount From table tempcurrentamount
            #===================================================================================
          //Check If Amount is greater than foodcash
            $deductFromPayCash = 0;

            if($order_amount_in_system_rate > $account->foodcash){
                $deductFromPayCash = $order_amount_in_system_rate - $account->foodcash;
            }

          //Perform Deduction
            if($deductFromPayCash > 0 && $account->payoutcash > 0){

                DB::table('tempcurrentamount')
                ->where('userid', '=', $user_id)
                ->decrement('foodcash', $account->foodcash);

                DB::table('tempcurrentamount')
                ->where('userid', '=', $user_id)
                ->decrement('payoutcash', $deductFromPayCash);
            }else{
                DB::table('tempcurrentamount')
                ->where('userid', '=', $user_id)
                ->decrement('foodcash', $order_amount_in_system_rate);
            }
            #===================================================================================

            // $result = DB::table('tempcurrentamount')->decrement('foodcash', $order_amount_in_system_rate);

            //If Decrement Fails, ROLLBACK TRANSACTION

            //Add Items to table mlm_foodcollection
            for ($i=0; $i < count($product_id); $i++) {

                //Check if Product is empty  
                if($product_id[$i] == 0){
                    continue;
                }

                //Insert Info into mlm_foodcollection table
                DB::table('mlm_foodcollection')->insert([
                    'user_id' => $user_id,
                    'group_leader_id' => $request->group_leader_id,
                    'product_id' => $product_id[$i],
                    'quantity' => $quantity[$i],
                    'amount' => $amount[$i],
                    'date_created' => $date_created,
                    ]);
            }

            //Log collected item To table mlm_goodscollectionlog
            DB::table('mlm_goodscollectionlog')->insert([
                'user_id' => $user_id,
                'prev_amount' => $account->foodcash + $account->payoutcash,
                'amount_deducted' => $order_amount_in_system_rate,
                'trans_date' => date('Y-m-d h:i:s'),
                ]);

            // IF NOT QUERY FAILS, COMMIT TRANSACTION
            DB::commit();

            Session::flash('flash_success','Your Food Collection Form has been submitted.');
            return json_encode("Successful");

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode("Something went wrong");
            // something went wrong
        }
    }
    
    // 19/10/2017 - Changed private to public because of API
    public function getSubAccountDetails($parent_id)
    {
      return DB::table('member_table')
      ->join('tempcurrentamount','member_table.membershipid','=','tempcurrentamount.userid')
      ->select(DB::raw('tempcurrentamount.userid, tempcurrentamount.regpack, tempcurrentamount.foodcash, member_table.joindate, member_table.stage, tempcurrentamount.payoutcash'))
      ->where('isownedby', '=', $parent_id)
      ->where('type', '=', 'subaccount')
      ->get();
  }


    #======================================================================================================================
    #                                               REPORTS GENERATION
    #======================================================================================================================

  public function reportGenerator(Request $request){

        $date_start = trim(explode('-', $request->date)[0]);
        $date_start = str_replace('/', '-', $date_start);

        $date_end = trim(explode('-', $request->date)[1]);
        $date_end = str_replace('/', '-', $date_end);

        if($request->report_id == 1){

            $this->getGroupLeaderList($date_start, $date_end, $request->group_id, $request->country, $request->state);

        }else if($request->report_id == 2){

            $this->getAdminReport($date_start, $date_end, $request->group_id, $request->country, $request->state);

        }else if($request->report_id == 3){

            $this->getProductQuantityReport($date_start, $date_end, $request->country, $request->state);

        }else if($request->report_id == 4){

            $this->getEligibleGroupReports($date_start, $date_end, $request->group_id, $request->country, $request->state);

        }else{

        }
    }

public function getAdminReport($date_start, $date_end, $group_id, $country, $state)
{
    if ($group_id == 0) {
        $group_ids = DB::select("SELECT DISTINCT f.group_leader_id as group_id, g.group_name, g.owner_id, m.firstname,m.middlename,m.lastname,m.phonenumber FROM mlm_foodcollection f INNER JOIN mlm_groups g ON g.id = f.group_leader_id LEFT JOIN member_table m ON g.owner_id = m.membershipid WHERE g.deleted_at IS NULL AND g.country = '$country' AND g.state = '$state' AND f.date_created BETWEEN '$date_start' AND '$date_end'");


            // table('mlm_groups')->leftJoin('mlm_foodcollection','mlm_foodcollection.group_id','=','mlm_groups.owner_id')->leftJoin('member_table','member_table.membershipid','=','mlm_groups.owner_id')->select('mlm_groups.id as group_id','mlm_groups.group_name','mlm_groups.owner_id', 'member_table.*')->get();

            // $group_ids = DB::table('mlm_groups')->leftJoin('mlm_foodcollection','mlm_foodcollection.group_id','=','mlm_groups.owner_id')->leftJoin('member_table','member_table.membershipid','=','mlm_groups.owner_id')->select('mlm_groups.id as group_id','mlm_groups.group_name','mlm_groups.owner_id', 'member_table.*')->get();
    }else{
        // $group_ids = DB::table('mlm_groups')->leftJoin('member_table','member_table.membershipid','=','mlm_groups.owner_id')->select('mlm_groups.id as group_id','mlm_groups.group_name','mlm_groups.owner_id', 'member_table.*')->whereNull('mlm_groups.deleted_at')->where('mlm_groups.id', $group_id)->where('mlm_groups.country', $country)->where('mlm_groups.state')->get();

        $group_ids = DB::table('mlm_groups')->leftJoin('member_table','member_table.membershipid','=','mlm_groups.owner_id')->select('mlm_groups.id as group_id','mlm_groups.group_name','mlm_groups.owner_id', 'member_table.*')->whereNull('mlm_groups.deleted_at')->where('mlm_groups.id', $group_id)->get();
    }

    $report = DB::select("SELECT mlm_foodcollection.group_leader_id, mlm_foodcollection.user_id, mlm_foodcollection.product_id, product.item_name, SUM(mlm_foodcollection.quantity) as total FROM mlm_foodcollection LEFT JOIN product ON product.id = mlm_foodcollection.product_id WHERE mlm_foodcollection.date_created BETWEEN '$date_start' AND '$date_end' GROUP BY mlm_foodcollection.product_id, mlm_foodcollection.group_leader_id");

    $html = '';

    foreach ($group_ids as $key => $id) {
        $html .= '<div class="box box-default page-break"><div class="box-header with-border">
        <h3 class="box-title"><b>Total Food Items For <u>'.$id->group_name.'</u> Requested Between '. date_format(date_create($date_start), "d-M-Y").' And '.date_format(date_create($date_end), "d-M-Y").'</b></h3></div><div class="box-body">';

        $html .= '<table class="table table-striped table-bordered">';
        $html .= '<tr><th>Group Information</th><th>Request</th></tr>';
        $html .= '<tr><td><b>Group Name:</b> '.$id->group_name.'<br><b>Owner ID:</b> '.$id->owner_id.'<br><b>Owner First Name:</b> '.$id->firstname.'<br><b>Owner Middle Name:</b> '.$id->middlename.'<br><b>Owner Last Name:</b> '.$id->lastname.'<br><b>Owner Phone No:</b> '.$id->phonenumber.'</td><td>';

        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>Item</th><th>Quantity</th></tr>';
        foreach ($report as $r) {
            if($id->group_id == $r->group_leader_id){
                $html .= '<tr><td>'.$r->item_name.'</td><td>'.$r->total.'</td></tr>';
            }
        }
        $html .= '</table>';

        $html .= '</table><div class="text-center"></div>';
        $html .= '</div></div>';
    }

    echo $html;
}

public function getEligibleGroupReports($date_start, $date_end, $group_id, $country, $state)
{
    $group_ids = DB::select("SELECT DISTINCT f.group_leader_id as group_id, g.group_name, g.owner_id, m.firstname,m.middlename,m.lastname,m.phonenumber FROM mlm_foodcollection f INNER JOIN mlm_groups g ON g.id = f.group_leader_id LEFT JOIN member_table m ON g.owner_id = m.membershipid WHERE g.deleted_at IS NULL AND g.country = '$country' AND g.state = '$state' AND f.date_created BETWEEN '$date_start' AND '$date_end'");

    $html = '';

    $html .= '<div class="box box-default page-break"><div class="box-header with-border"><h3 class="box-title"><b>Groups Eligible For Collection Between '. date_format(date_create($date_start), "d-M-Y").' And '.date_format(date_create($date_end), "d-M-Y").'</b></h3></div><div class="box-body">';

    $html .= '<table class="table table-striped table-bordered">';
    $html .= '<tr><th>S/N</th><th>Group Name</th><th>Leader ID</th><th>Leader Name.</th><th>Leader Phone No.</th><th>Signature/Date</th></tr>';
    foreach ($group_ids as $key => $id) {
        $html .= '<tr><td>'.($key + 1).'</td><td><b>'.$id->group_name.' - '.$id->group_id.' <br></td><td>'.$id->owner_id.'</td><td>'.$id->firstname.' '.$id->middlename.' '.$id->lastname.'</td><td>'.$id->phonenumber.'</td><td></td></tr>';
    }
    $html .= '</table>';
    $html .= '</div></div>';

    echo $html;
}

public function getGroupLeaderList($date_start, $date_end, $group_id, $country, $state)
{
    if ($group_id == 0) {
        $group_ids = DB::select("SELECT DISTINCT f.group_leader_id, g.* FROM mlm_foodcollection f INNER JOIN mlm_groups g ON g.id = f.group_leader_id LEFT JOIN member_table m ON g.owner_id = m.membershipid WHERE g.deleted_at IS NULL AND g.country = '$country' AND g.state = '$state' AND f.date_created BETWEEN '$date_start' AND '$date_end'");
            // $group_ids = DB::table('mlm_groups')->get();
            
    }else{
        // $group_ids = DB::table('mlm_groups')->whereNull('deleted_at')->where('id', $group_id)->where('country', $country)->where('state', $state)->get();
        $group_ids = DB::table('mlm_groups')->whereNull('deleted_at')->where('id', $group_id)->get();
        // echo "";
        // return;
    }

    $users = DB::select("SELECT DISTINCT m.user_id, m.group_leader_id,member_table.username, member_table.phonenumber,member_table.firstname,member_table.middlename,member_table.lastname FROM mlm_foodcollection m LEFT JOIN member_table ON m.user_id = member_table.membershipid WHERE m.date_created BETWEEN '$date_start' AND '$date_end'");

    $report = DB::select("SELECT m.*, product.item_name FROM mlm_foodcollection m INNER JOIN product ON product.id = m.product_id WHERE m.date_created BETWEEN '$date_start' AND '$date_end'");

    // dd($report);

    $html='';

    foreach ($group_ids as $key => $id) {
        $html .= '<div class="box box-default page-break"><div class="box-header"><h3 class="box-title"><div class="text-center"><h2>feed the nations </h2></div><b>Food Items For Members In <u>'.$id->group_name.'</u> Requested Between '. date_format(date_create($date_start), "d-M-Y").' And '.date_format(date_create($date_end), "d-M-Y").'</b></h3></div><div class="box-body">';

        $html .= '<table class="table table-striped table-bordered">';
        $html .= '<tr><th>User Information</th><th>Request</th></tr>';

        foreach ($users as $key => $u) {
            if($u->group_leader_id == $id->id){
                $html .= '<tr><td><b>User ID:</b> '.$u->user_id.'<br><b>Username:</b> '.$u->username.'<br><b>First Name:</b> '.$u->firstname.'<br><b>Middle Name:</b> '.$u->middlename.'<br><b>Last Name:</b> '.$u->lastname.'<br><b>Phone:</b> '.$u->phonenumber.'</td><td>';
                $html .= '<table class="table table-bordered">';
                $html .= '<tr><th>Item</th><th>Quantity</th></tr>';
                foreach ($report as $r) {
                    if($u->user_id == $r->user_id && $r->group_leader_id == $id->id){
                        $html .= '<tr><td>'.$r->item_name.'</td><td>'.$r->quantity.'</td></tr>';
                    }
                }
                $html .= '</table>';
                $html .= '</td></tr>';
            }
        }

        $html .= '</table>';
        $html .= '</div></div>';
    }

    echo $html;
}

public function getProductQuantityReport($date_start, $date_end, $country, $state)
{

    $box_top = '<div class="box box-default page-break"><div class="box-header with-border"><h3 class="box-title"><b>'.ucfirst($state).' State Procurement List For Food Requests Between '. date_format(date_create($date_start), "d-M-Y").' And '.date_format(date_create($date_end), "d-M-Y").'</b></h3></div><div class="box-body">';

    $box_bottom = '</div></div>';

    $report = DB::select("SELECT SUM(m.quantity) as totalQty, SUM(m.quantity * m.amount) as totalAmt, product.item_name FROM mlm_foodcollection m INNER JOIN product ON product.id = m.product_id INNER JOIN mlm_groups ON mlm_groups.id = m.group_leader_id WHERE m.date_created BETWEEN '$date_start' AND '$date_end' AND mlm_groups.country = '$country' AND mlm_groups.state = '$state' GROUP BY product_id");

    $html = '<table class="table table-striped table-hover"><thead><tr><th>S/N</th><th>ITEMS</th><th>QUANTITY</th><th>AMOUNT</th></tr></thead><tbody>';

    foreach ($report as $key => $r) {
        $html .= '<tr><td>'.($key + 1).'</td><td>'.$r->item_name.'</td><td>'.$r->totalQty.'</td><td> #'.($r->totalAmt * 200).'</td></tr>';
    }
    $html .= '</tbody></table>';    

    echo $box_top . $html . $box_bottom;
}


    #======================================================================================================================
    #                                               GROUPS
    #======================================================================================================================

public function createGroup(Request $request)
{
        // Validate the Request through the validation rules
    $validator=Validator::make($request->all(),
        [
        'owner_id'=>'required|unique:mlm_groups|max:255',
        'group_name'=>'required|unique:mlm_groups|max:255',
        ]);

        // Take actions when the validation has failed
    if ($validator->fails()){
        $html = self::listGroup();
        return '<tr><td colspan="4" class="text-danger"><b>ERROR:  GROUP NAME or USER ID already exits</b></td></tr>' . $html;
    }

    $result = DB::table('mlm_groups')->insert([
        'owner_id'=> $request->owner_id,
        'group_name'=> $request->group_name,
        'country'=> $request->group_country,
        'state'=> $request->group_state,
        'created_at'=> date('Y-m-d H:i:s')
        ]);

    if($result){
        $groups = DB::table('mlm_groups')->whereNull('deleted_at')->get();
        $html = '';
        foreach ($groups as $key => $group) {
            $html .= '<tr><td>'.($key + 1).'</td><td id="owner_id-'.$group->id.'" onblur="updateGroup(\'owner_id-'.$group->id.'\')" contenteditable="true">'.$group->owner_id.'</td><td contenteditable="true" id="group_name-'.$group->id.'" onblur="updateGroup(\'group_name-'.$group->id.'\')">'.$group->group_name.'</td><td><button data-rowid="'.($key + 1).'" id="delete'.$group->id.'"  onclick="deleteGroup('.$group->id.')" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td></tr>';
        }
        return $html;
    }else{
        return 'empty';
    }
}

public function getHistory()
{
    $user_id = DB::table('member_table')->where('username', Auth::user()->username)->first()->membershipid;

    $report = DB::select("SELECT m.date_created, product.item_name, m.quantity, m.amount FROM mlm_foodcollection m INNER JOIN product ON product.id = m.product_id WHERE m.user_id = '$user_id' ORDER BY m.date_created DESC");

    $lastElement = end($report);

    $jsontext = '{"data": [';
    foreach ($report as $key => $r) {
        if ($r == $lastElement) {
            $jsontext .= '["'.($key + 1).'","'.$r->date_created.'","'.$r->item_name.'","'.$r->quantity.'","'.$r->amount.'"]';
        }else{
            $jsontext .= '["'.($key + 1).'","'.$r->date_created.'","'.$r->item_name.'","'.$r->quantity.'","'.$r->amount.'"],';
        }
    }

    $jsontext .= ']}';
    return $jsontext;
}

public function listGroup()
{
    $groups = DB::table('mlm_groups')->whereNull('deleted_at')->get();
    $html = '';
    foreach ($groups as $key => $group) {
        $html .= '<tr>
        <td>'.($key + 1).'</td>
            <td id="owner_id-'.$group->id.'">'.$group->owner_id.'</td>
            <td id="group_name-'.$group->id.'">'.$group->group_name.'</td>
            <td id="group_country-'.$group->id.'">'.$group->country.'</td>
            <td id="group_state-'.$group->id.'">'.$group->state.'</td>
            <td>
                <button data-rowid="'.($key + 1).'" id="'.$group->id.'"  onclick="showEditGroupModal('.$group->id.')" type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button> 
                &nbsp;
                <button data-rowid="'.($key + 1).'" id="delete'.$group->id.'"  onclick="deleteGroup('.$group->id.')" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
        </tr>';
    }
    return $html;
}

public function deleteGroup(Request $request)
{
    DB::table('mlm_groups')->where('id', $request->id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
    return self::listGroup();
}

public function updateGroup(Request $request)
{
    DB::table('mlm_groups')->where('id', $request->id)->whereNull('deleted_at')->update(
            [
                'owner_id' => $request->owner_id,
                'group_name' => $request->group_name,
                'country' => $request->country,
                'state' => $request->state
            ]
        );
    return self::listGroup();       
}

    // NEW @ 29-March-2017 ===================================================================================
public function reportGeneratorForLeaders(Request $request)
{
        //Check If User is a group leader
    $user_id = DB::table('member_table')->where('username', Auth::user()->username)->first()->membershipid;

    $result = DB::table('mlm_groups')->whereNull('deleted_at')->where('owner_id', $user_id)->first();

    if(!$result){
        $box_top = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>SORRY!</strong>&nbsp;You are not a group leader.</div>';
        return $box_top;

    }else{

        $date_start = trim(explode('-', $request->date)[0]);
        $date_start = str_replace('/', '-', $date_start);

        $date_end = trim(explode('-', $request->date)[1]);
        $date_end = str_replace('/', '-', $date_end);

        if($request->report_id == 1){
            
            $this->getGroupLeaderList($date_start, $date_end, $result->id,'','');
        }else if($request->report_id == 2){

            $this->getAdminReport($date_start, $date_end, $result->id,'','');
        }else{

        }
    }
}

// NEW @ 01-MAY-2017
public function getGroup(Request $request)
{
    return json_encode((Object)DB::table('mlm_groups')->whereNull('deleted_at')->where('id', $request->id)->first());
}
//food collection for sub account added by Joseph 10/07/2017

    public function showEachAccountFoodReport(Request $request)
    {
        $accountMembershipId=$request->membershipid;
        $date=$request->date;
        $date_start=$request->start;
        $date_end=$request->end;
        $this->getAccountFoodReport($date_start,$date_end,$accountMembershipId);

    }

    public function getAccountFoodReport(Request $request)
    {

        $date=$request->date;
        $date_start = trim(explode('-', $date)[0]);
        $date_start = str_replace('/', '-', $date_start);

        $date_end = trim(explode('-', $date)[1]);
        $date_end = str_replace('/', '-', $date_end);

        $membershipid = trim(explode('_', $request->membershipid)[0]);

        //$date_end=$request->date_end;date_start;
       $report=DB::table('mlm_foodcollection as m')
              ->join('product as p', 'm.product_id', '=', 'p.id')
              ->join('mlm_groups as mg', 'm.group_leader_id', '=', 'mg.id')
              ->where('m.user_id','=',$membershipid)
              ->whereBetween('m.date_created', [$date_start,$date_end])
              ->select('m.*','p.*','m.quantity as orderquantity','mg.owner_id as groupleadermembershipid','mg.group_name as group_name')
            ->get();

         foreach ($report as $rep){

             $groupleadermembershipid=$rep->groupleadermembershipid;
             $group_name=$rep->group_name;

             $result=DB::table('member_table as m')
                 ->where('m.membershipid','=',$groupleadermembershipid)
                 ->first();
             $phonenumber= $result->phonenumber;
         }


        $box_top = '<div class="box box-default page-break"><div class="box-header with-border"><h3 class="box-title"><b>Food Order List For '.$membershipid.' between '. date_format(date_create($date_start), "d-M-Y").' And '.date_format(date_create($date_end), "d-M-Y").'</b></h3></div><div class="box-body">';

        $box_bottom = '</div></div>';

        $html3='';
        $html3 .= '<table class="table table-bordered">';

        $html3 .= '<tr><th>Group Leader ID</th><th>'.$groupleadermembershipid.'</th></tr>';
        $html3 .= '<tr><th>Group Name</th><th>'.$group_name.'</th></tr>';
        $html3 .= '<tr><th>Phone Number </th><th>'.$phonenumber.'</th></tr>';



        $html3 .= '</table>';


        $html='';
        $html .= '<table class="table table-bordered">';

        $html .= '<tr><th>ID</th><th>Date</th><th>Item</th><th>Quantity</th><th>Amount</th></tr>';
        foreach ($report as $key => $r) {
            $html .= '<tr><td>'.($key + 1).'</td><td>'.$r->date_created.'</td><td>'.$r->item_name.'</td><td>'.$r->orderquantity.'</td><td>$'.$r->amount.'</td></tr>';
        }
        $html .= '</table>';

        $html2=$box_top.$html3.$html.$box_bottom;

        $result2=["data"=>$html2];


        return response()->json($result2);

    }

    public function showAccountFoodReportPage()
    {
        return view('foodcollection.accountfoodreport');
    }

    public function returnJsonForUserMembershipIdAndSubAccountDetails()
    {
        $user_id = DB::table('member_table')->where('username', Auth::user()->username)->first()->membershipid;
        $subaccounts = $this->getSubAccountDetails($user_id);
        return json_encode(['user_id' => $user_id, 'subaccounts' => $subaccounts]);
    }

    public function reverseOrderByGroup(Request $request)
    {
        dd("Closed");
        DB::beginTransaction();
        

        try {

            // get the group id
            $group_leader_id = $request->group_leader_id;

            // get the order date
            $date = '2018/11/22 - 2018/11/24';
            $date_start = trim(explode('-', $date)[0]);
            $date_start = str_replace('/', '-', $date_start);

            $date_end = trim(explode('-', $date)[1]);
            $date_end = str_replace('/', '-', $date_end);
            
            // get total amount in mlm_foodcollection        
            $totalAmountAndUsers = DB::select("SELECT user_id, SUM(quantity * amount) as total_amount_deducted FROM mlm_foodcollection WHERE group_leader_id = '$group_leader_id' AND date_created BETWEEN '$date_start' AND '$date_end' group by user_id");

            foreach ($totalAmountAndUsers as $r) {

                // set date in mlm_foodcollection to 0000-00-00
                DB::table('mlm_foodcollection')->where('user_id', $r->user_id)->where('group_leader_id', $group_leader_id)->whereBetween('date_created', [$date_start, $date_end])->update(['date_created' => '0000-00-00']);
                
                // set date in mlm_goodscollection to 0000-00-00
                DB::update("update mlm_goodscollectionlog set trans_date = '0000-00-00 00:00:00' where user_id = '$r->user_id' and trans_date BETWEEN '$date_start' AND '$date_end'");

                // update tmpcurrent amount with total_amount for the order
                DB::table('tempcurrentamount')->where('userid', '=', $r->user_id)->increment('foodcash', $r->total_amount_deducted);

                dump($r->user_id . " has been credited with " . $r->total_amount_deducted);

            }

            // IF NOT QUERY FAILS, COMMIT TRANSACTION
            DB::commit();

            // Session::flash('flash_success','Your Food Collection Form has been submitted.');
            return json_encode("Successful");

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            dump($e);
            return json_encode("Something went wrong");
        }
    }
}
