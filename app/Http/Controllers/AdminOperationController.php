<?php

namespace App\Http\Controllers;

use App\GraphDB\MySQLToGraphDB;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class AdminOperationController extends Controller
{
    private $graphdb;

    public function __construct()
    {
        $this->middleware('auth');
        $this->graphdb = new MySQLToGraphDB();
    }

    public function getParentIndex()
    {
        return view('adminoperation.index');
    }

    public function getParent(Request $request)
    {
        $result = DB::table('treepaths')->leftJoin('member_table', 'member_table.membershipid', '=', 'treepaths.ancestor')->where('treepaths.descendant', $request->user_id)->where('treepaths.depth', 1)->first();

        $html = '<div><h3>User Parent Information</h3></div>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><td><b>User ID</b></td><td>' . $result->membershipid . '</td></tr>';
        $html .= '<tr><td><b>Fullname</b></td><td>' . $result->firstname . ' ' . $result->middlename . ' ' . $result->lastname . '</td></tr>';
        $html .= '<tr><td><b>Stage</b></td><td>' . $result->stage . '</td></tr>';
        $html .= '<tr><td><b>Username</b></td><td>' . $result->username . '</td></tr>';
        $html .= '<tr><td><b>Account Type</b></td><td>' . $result->type . '</td></tr>';
        $html .= '<tr><td><b>Is Owned By</b></td><td>' . $result->isownedby . '</td></tr>';
        $html .= '<tr><td><b>Date of Registration</b></td><td>' . $result->joindate . '</td></tr>';
        $html .= '</table>';

        return $html;
    }

    public function getuserInfo(Request $request)
    {
        $result = DB::table('member_table')->where('membershipid', $request->user_id)->first();

        $html = '<div><h3>User Personal Information</h3></div>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><td><b>User ID</b></td><td>' . $result->membershipid . '</td></tr>';
        $html .= '<tr><td><b>Fullname</b></td><td>' . $result->firstname . ' ' . $result->middlename . ' ' . $result->lastname . '</td></tr>';
        $html .= '<tr><td><b>Stage</b></td><td>' . $result->stage . '</td></tr>';
        $html .= '<tr><td><b>Username</b></td><td>' . $result->username . '</td></tr>';
        $html .= '<tr><td><b>Phone Number</b></td><td>' . $result->phonenumber . '</td></tr>';
        $html .= '<tr><td><b>Account Type</b></td><td>' . $result->type . '</td></tr>';
        $html .= '<tr><td><b>Parent ID</b></td><td>' . strtoupper($result->parentid) . '</td></tr>';
        $html .= '<tr><td><b>Sponsor ID</b></td><td>' . strtoupper($result->sponsorid) . '</td></tr>';
        $html .= '<tr><td><b>Is Owned By</b></td><td>' . strtoupper($result->isownedby) . '</td></tr>';
        $html .= '<tr><td><b>Date of Registration</b></td><td>' . $result->joindate . '</td></tr>';
        $html .= '</table>';

        return $html;
    }

    public function getPINStatus(Request $request)
    {
        $result = DB::table('member_table')->leftJoin('generatepin', 'generatepin.membershipid', '=', 'member_table.membershipid')->where('member_table.membershipid', $request->pin_id)->first();
        $html = '<div><h3>PIN Status</h3></div>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><td><b>User ID</b></td><td>' . $result->membershipid . '</td></tr>';
        $html .= '<tr><td><b>Fullname</b></td><td>' . $result->firstname . ' ' . $result->middlename . ' ' . $result->lastname . '</td></tr>';
        $html .= '<tr><td><b>Stage</b></td><td>' . $result->stage . '</td></tr>';
        $html .= '<tr><td><b>Username</b></td><td>' . $result->username . '</td></tr>';
        $html .= '<tr><td><b>Account Type</b></td><td>' . $result->type . '</td></tr>';
        $html .= '<tr><td><b>Is Owned By</b></td><td>' . $result->isownedby . '</td></tr>';
        $html .= '<tr><td><b>Date of Registration</b></td><td>' . $result->joindate . '</td></tr>';
        $html .= '<tr><td><b>Phone Number</b></td><td>' . $result->phonenumber . '</td></tr>';
        $html .= '<tr><td><b>PIN</b></td><td>' . $result->pin . '</td></tr>';
        $html .= '<tr><td><b>Pin Used</b></td><td>' . $result->used . '</td></tr>';
        $html .= '</table>';

        return $html;
    }

    public function getPINReprint(Request $request)
    {
        $ids = explode('-', trim($request->pin_range));
        if (count($ids) == 2) {
            $result = DB::table('generatepin')->whereBetween('id', array($ids[0], $ids[1]))->get();
        } else {
            $result = DB::table('generatepin')->where('id', $request->pin_range)->get();
        }

        $html = '<div><h3>PIN Re-PRINT</h3></div>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>ID</th><th>Membership ID</th><th>PIN</th></tr>';
        foreach ($result as $key => $result) {
            $html .= '<tr><td>' . $result->id . '</td><td><b>' . $result->membershipid . '</b></td><td>' . $result->pin . '</td></tr>';
        }
        $html .= '</table>';

        return $html;
    }

    public function getDownlines(Request $request)
    {
        $result = DB::table('treepaths')->leftJoin('member_table', 'member_table.membershipid', '=', 'treepaths.descendant')->where('treepaths.ancestor', $request->user_id)->get();

        $html = '<div><h3>User Downlines Information</h3></div>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>ID</th><th>Membership ID</th><th>Full Name</th><th>Username</th><th>Phone Number</th><th>Stage</th><th>Position</th><th>Date Registered</th></tr>';

        foreach ($result as $key => $result) {
            $html .= '<tr><td>' . ($key + 1) . '</td><td><b>' . $result->membershipid . '</b></td><td>' . $result->firstname . ' ' . $result->middlename . ' ' . $result->lastname . '</td><td>' . $result->username . '</td><td>' . $result->phonenumber . '</td><td>' . $result->stage . '</td><td>' . $result->position . '</td><td>' . $result->joindate . '</td></tr>';
        }

        $html .= '</table>';

        return $html;
    }

    public function getMatrix(Request $request)
    {
        $html = '';
        $result = DB::table('matrix')->where('ownerid', $request->user_id)->orderBy('type_id', 'ASC')->get();

        // Display Matrix
        $html .= '<div><h3>User Matrix Information</h3></div>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>ID</th><th>Owner ID</th><th>Matrix Type</th><th>No of Users</th><th>Is Filled</th><th>Date Created</th></tr>';

        foreach ($result as $k => $r) {
            $html .= '<tr><td>' . ($k + 1) . '</td><td><b>' . $r->ownerid . '</b></td><td> Stage ' . $r->type_id . ' Matrix</td><td>' . $r->count_users . '</td><td>' . $r->filled . '</td><td>' . $r->created_at . '</td></tr>';
        }

        $html .= '</table>';

        // Display The Matrix Users
        foreach ($result as $key2 => $res) {

            $result2 = DB::table('matrix_users')->leftJoin('member_table', 'member_table.membershipid', '=', 'matrix_users.user_id')->select('matrix_users.position', 'member_table.firstname', 'member_table.middlename', 'member_table.lastname', 'member_table.username', 'member_table.phonenumber', 'member_table.stage', 'member_table.membershipid')->where('matrix_users.matrix_id', $res->matrix_id)->orderBy('matrix_users.user_id', 'DESC')->orderBy('matrix_users.position', 'ASC')->get();

            $html .= '<div class="text-center"><h3><u>Stage ' . $key2 . ' Matrix</u></h3></div>';
            $html .= '<table class="table table-bordered">';
            $html .= '<tr><th>ID</th><th>Membership ID</th><th>Full Name</th><th>Username</th><th>Phone Number</th><th>Stage</th><th>Matrix Position</th></tr>';

            foreach ($result2 as $key => $val) {
                $html .= '<tr><td>' . ($key + 1) . '</td><td><b>' . $val->membershipid . '</b></td><td>' . $val->firstname . ' ' . $val->middlename . ' ' . $val->lastname . '</td><td>' . $val->username . '</td><td>' . $val->phonenumber . '</td><td>' . $val->stage . '</td><td>' . $val->position . '</td></tr>';
            }
            $html .= '</table>';
        }
        return $html;
    }

    public function getProducts()
    {
        return json_encode(DB::table('product')->get());
    }

    public function updateProductInfo(Request $request)
    {
        $result = DB::table('product')->where('id', $request->id)->update([
            'price' => $request->price,
            'item_name' => $request->item_name,
        ]);
        if ($result) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public function getUserAccountBalance(Request $request)
    {
        $result = DB::table('member_table')->leftJoin('tempcurrentamount', 'tempcurrentamount.userid', '=', 'member_table.membershipid')->where('member_table.membershipid', $request->user_id)->first();
        
        $refferalbonus=DB::table('refferal_bonus')->where('membershipid','=',$request->user_id)->sum('bonus');

    	$stagecompletionbonus=DB::table('stagecompletionbonus')->where('userid','=',$request->user_id)->sum('amount');

    	$singlebonuspaid=DB::table('singlebonuspaid')->where('userid','=',$request->user_id)->sum('amount');
    	$totalearning=$refferalbonus+$stagecompletionbonus+$singlebonuspaid;
    	$totalinnaira=$totalearning*200;
    	
        $html = '<div>User Account Balance Information</div>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><td><b>User ID</b></td><td>' . $result->membershipid . '</td></tr>';
        $html .= '<tr><td><b>Fullname</b></td><td>' . $result->firstname . ' ' . $result->middlename . ' ' . $result->lastname . '</td></tr>';
        $html .= '<tr><td><b>Stage</b></td><td>' . $result->stage . '</td></tr>';
        $html .= '<tr><td><b>Username</b></td><td>' . $result->username . '</td></tr>';
        $html .= '<tr><td><b>Food Cash Balance</b></td><td>' . $result->foodcash . '</td></tr>';
        $html .= '<tr><td><b>Payout Cash  Balance</b></td><td>' . $result->payoutcash . '</td></tr>';
        $html .= '<tr><td><b>Referral Bonus Earned</b></td><td>'.$refferalbonus.'</td></tr>';
		$html .= '<tr><td><b>Single Bonus Earned</b></td><td>'.$stagecompletionbonus.'</td></tr>';
		$html .= '<tr><td><b>Stage Compeletion Bonus Earned</b></td><td>'.$singlebonuspaid.'</td></tr>';
		$html .= '<tr><td><b>Total amount Earned</b></td><td>$'.$totalearning.' (equivalent to )'.$totalinnaira.'  Naira</td></tr>';
		$html .= '</table>';
        $html .= '</table>';

        $html .= '<br>';
        $html .= '<div><strong>Incoming Transfer</strong></div>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>ID</th><th>Sender</th><th>Amount</th><th>Transfer Date</th></tr>';

        $result = DB::table('transactionsrecords')->where('receiverid', $request->user_id)->orderBy('created_at', 'DESC')->get();

        foreach ($result as $k => $r) {
            $html .= '<tr><td>' . ($k + 1) . '</td><td>' . $r->userid . '</td><td>' . $r->amount . '</td><td>' . $r->created_at . '</td></tr>';
        }
        $html .= '</table>';

        $html .= '<br>';
        $html .= '<div><strong>Outgoing Transfer</strong></div>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>ID</th><th>Receiver</th><th>Amount</th><th>Transfer Date</th></tr>';

        $result = DB::table('transactionsrecords')->where('userid', $request->user_id)->orderBy('created_at', 'DESC')->get();

        foreach ($result as $k => $r) {
            $html .= '<tr><td>' . ($k + 1) . '</td><td>' . $r->receiverid . '</td><td>' . $r->amount . '</td><td>' . $r->created_at . '</td></tr>';
        }
        $html .= '</table>';

        return $html;
    }

    public function getUserFoodCollectionLog(Request $request)
    {
        $result = DB::table('mlm_goodscollectionlog')->leftJoin('member_table', 'member_table.membershipid', '=', 'mlm_goodscollectionlog.user_id')->select('member_table.*', 'user_id', DB::Raw('SUM(amount_deducted) as total_goods_collected'))->where('user_id', $request->user_id)->where('amount_deducted', '>', 0)->orderBy('trans_date', 'DESC')->first();
        $refferalbonus=DB::table('refferal_bonus')->where('membershipid','=',$request->user_id)->sum('bonus');

    	$stagecompletionbonus=DB::table('stagecompletionbonus')->where('userid','=',$request->user_id)->sum('amount');

    	$singlebonuspaid=DB::table('singlebonuspaid')->where('userid','=',$request->user_id)->sum('amount');
    	$totalearning=$refferalbonus+$stagecompletionbonus+$singlebonuspaid;
    	$totalinnaira=$totalearning*200;
    	
    	
        $html = '<div><h3>User Food Collection Log</h3></div>';

        $html .= '<table class="table table-bordered">';
        $html .= '<tr><td><b>Membership ID</b></td><td>' . $result->user_id . '</td></tr>';
        $html .= '<tr><td><b>Fullname</b></td><td>' . $result->firstname . ' ' . $result->middlename . ' ' . $result->lastname . '</td></tr>';
        $html .= '<tr><td><b>Stage</b></td><td>' . $result->stage . '</td></tr>';
        $html .= '<tr><td><b>Username</b></td><td>' . $result->username . '</td></tr>';
        $html .= '<tr><td><b>Total Amount of Goods Collected</b></td><td>$ ' . $result->total_goods_collected . '</td></tr>';
        $html .= '<tr><td><b>Total amount Earned</b></td><td>$'.$totalearning.' (equivalent to )'.$totalinnaira.'  Naira</td></tr>';
        $html .= '</table>';

        $html .= '<br>';
        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>ID</th><th>Amount Deducted</th><th>Date Collected</th></tr>';

        $result = DB::table('mlm_goodscollectionlog')->where('user_id', $request->user_id)->where('amount_deducted', '>', 0)->orderBy('trans_date', 'DESC')->get();

        foreach ($result as $k => $r) {
            $html .= '<tr><td>' . ($k + 1) . '</td><td>' . $r->amount_deducted . '</td><td>' . $r->trans_date . '</td></tr>';
        }
        $html .= '</table>';

        $report = DB::select("SELECT m.*, product.item_name FROM mlm_foodcollection m INNER JOIN product ON product.id = m.product_id WHERE m.user_id = '$request->user_id' ORDER BY m.date_created DESC");

        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>ID</th><th>Date</th><th>Item</th><th>Quantity</th><th>Amount</th></tr>';
        foreach ($report as $key => $r) {
            $html .= '<tr><td>' . ($key + 1) . '</td><td>' . $r->date_created . '</td><td>' . $r->item_name . '</td><td>' . $r->quantity . '</td><td>$' . $r->amount . '</td></tr>';
        }
        $html .= '</table>';

        return $html;
    }

    // NEW ADMIN OPERATIONS MEMBER METHODS ADDED ON 27-APR-2017
    public function getUsername(Request $request)
    {
        $username = DB::table('member_table')->where('membershipid', $request->user_id)->first()->username;
        $uid = DB::table('users')->where('username', $username)->first()->id;
        return json_encode(['username' => $username, 'uid' => $uid]);
    }

    public function isUsernameUnique(Request $request)
    {
        $result = DB::table('member_table')->where('username', $request->username)->get();
        if (count($result) > 0) {
            return 'NO';
        } else {
            return 'YES';
        }
    }

    public function changeUsername(Request $request)
    {
        DB::beginTransaction();

        try {

            DB::table('member_table')->where('membershipid', $request->userid)->update(['username' => $request->username]);

            DB::table('users')->where('id', $request->uid)->update(['username' => $request->username]);

            // IF NOT QUERY FAILS, COMMIT TRANSACTION
            DB::commit();
            return "TRUE";

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            return "FALSE";
            // something went wrong
        }
    }

    public function getPINInformation(Request $request)
    {
        return json_encode(DB::table('generatepin')->select('generatepin.pin', 'generatepin.used', 'member_table.membershipid')->leftJoin('member_table', 'generatepin.membershipid', '=', 'member_table.membershipid')->where('generatepin.membershipid', $request->pin_id)->first());
    }

    public function unsetUsedPIN(Request $request)
    {
        return json_encode(DB::table('generatepin')->where('membershipid', $request->userid)->update(['used' => 0]));
    }

//     ADDED ON 07/08/2018 Checking and Fixing Depth Related Issues

    public function checkDepthIssue(Request $request)
    {

        $result = $this->graphdb->checkIfDepthRelated($request->user_id, $request->parent_id);

        $html = '';

        if ($result) {
            $html = '<div>Downline Membership ID: ' . $request->user_id . '<br>Downline Stage: ' . $result . '<br>' . $request->user_id . ' is related to ' . $request->parent_id . ' with a depth of 5<br><br></div>';
        } else {
            $html = '<div>' . $request->user_id . ' is either NOT related to ' . $request->parent_id . ' or the depth is greater than 5</div>';
        }

        return $html;
    }

    public function fixStageOneDepthIssue(Request $request)
    {
        $membershipid = $request->user_id;

        $this->graphdb->setStageInGraphDB($membershipid, 1);
        $result = DB::table('member_table')->where('membershipid', $membershipid)->first();
        if ($result->stage == 1) {
            $this->graphdb->setStageInGraphDB($membershipid, 1);
            $html = '<div>User depth issue has been fixed.</div>';
        } else {
            $html = '<div>Something is not right, contact IT department.</div>';
        }

        return $html;
    }

    public function getMembersFinancialRecord(Request $request)
    {
        $date = $request->date;

        $stages = DB::table("member_table")->select('stage')->distinct()->orderBy('stage', 'asc')->get();

        $registeredMembers = [];
        $currentamount = [];

        foreach ($stages as $key => $st) {

            $stage = $st->stage;

            // Get the total number of registred users in a stage
            $tmp_reg_members = DB::table("member_table")->where('stage', $stage)->count();
            array_push($registeredMembers, $tmp_reg_members);

            // // Get the total number of registred users in a stage
            // $resultsNegetive = DB::select(DB::raw("select sum(tempcurrentamount.foodcash) as foodcash, sum(tempcurrentamount.payoutcash) as payoutcash from member_table join tempcurrentamount on tempcurrentamount.userid = member_table.membershipid where member_table.stage = :stage"), array(
            //     'stage' => $stage,
            // ));

            // Get the total number of registred users in a stage
            $resultsNegetiveFoodcash = DB::select(DB::raw("select sum(tempcurrentamount.foodcash) as ng_foodcash from member_table join tempcurrentamount on tempcurrentamount.userid = member_table.membershipid where tempcurrentamount.foodcash < 0 and member_table.stage = :stage"), array(
                'stage' => $stage,
            ));

            $resultsNegetivePayoutcash = DB::select(DB::raw("select sum(tempcurrentamount.payoutcash) as ng_payoutcash from member_table join tempcurrentamount on tempcurrentamount.userid = member_table.membershipid where tempcurrentamount.payoutcash < 0 and member_table.stage = :stage"), array(
                'stage' => $stage,
            ));

            // Get the total number of registred users in a stage
            $resultsPositiveFoodcash = DB::select(DB::raw("select sum(tempcurrentamount.foodcash) as pt_foodcash from member_table join tempcurrentamount on tempcurrentamount.userid = member_table.membershipid where tempcurrentamount.foodcash >= 0 and member_table.stage = :stage"), array(
                'stage' => $stage,
            ));

            $resultsPositivePayoutcash = DB::select(DB::raw("select sum(tempcurrentamount.payoutcash) as pt_payoutcash from member_table join tempcurrentamount on tempcurrentamount.userid = member_table.membershipid where tempcurrentamount.payoutcash >= 0 and member_table.stage = :stage"), array(
                'stage' => $stage,
            ));

            // array_push($currentamount, $results);
            array_push($currentamount, [$resultsNegetiveFoodcash, $resultsNegetivePayoutcash, $resultsPositiveFoodcash, $resultsPositivePayoutcash]);
        }

        // dump($currentamount);
        // dd();
        $totalFoodCash = 0;
        $totalPayoutCash = 0;
        $totalPositiveFoodCash = 0;
        $totalNegetiveFoodCash = 0;
        $totalPositivePayoutCash = 0;
        $totalNegetivePayoutCash = 0;

        $html = '';
        $html .= '<div class="box box-default page-break"><div class="box-header"><h3 class="box-title"><div class="text-center"><h2>feed the nations </h2><div class="box-body">';
        $html .= '<table class="table table-striped table-bordered">';
        $html .= '<div><h3>Total Members and Financial Records Printed On ' . date("l, F d, o") . '</h3></div>';

        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>Stage</th><th>Food Cash</th><th>Payout Cash</th><th>Food and Cash</th><th>Registered Members</th></tr>';
        foreach ($stages as $key => $st) {

            $totalPositiveFoodCash += ($currentamount[$key][2][0]->pt_foodcash);
            $totalNegetiveFoodCash += ($currentamount[$key][0][0]->ng_foodcash);

            $totalPositivePayoutCash += ($currentamount[$key][3][0]->pt_payoutcash);
            $totalNegetivePayoutCash += ($currentamount[$key][1][0]->ng_payoutcash);

            $stage = $st->stage;

            $html .= '<tr>
                    <td>' . $stage . '</td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <td>Positive</td>
                                <td>Negetive</td>
                            </tr>
                            <tr>
                                <td>' . ($currentamount[$key][2][0]->pt_foodcash) * 200 . '</td>
                                <td>' . ($currentamount[$key][0][0]->ng_foodcash) * 200 . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <td>Positive</td>
                                <td>Negetive</td>
                            </tr>
                            <tr>
                                <td>' . ($currentamount[$key][3][0]->pt_payoutcash) * 200 . '</td>
                                <td>' . ($currentamount[$key][1][0]->ng_payoutcash) * 200 . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <td>Positive</td>
                                <td>Negetive</td>
                            </tr>
                            <tr>
                                <td>' . ($currentamount[$key][2][0]->pt_foodcash + $currentamount[$key][3][0]->pt_payoutcash) * 200 . '</td>
                                <td>' . ($currentamount[$key][0][0]->ng_foodcash + $currentamount[$key][1][0]->ng_payoutcash) * 200 . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>' . $registeredMembers[$key] . '</td>
                </tr>';
        }

        $html .= '<tr>
                    <td><b>Total</b></td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <td>Positive</td>
                                <td>Negetive</td>
                            </tr>
                            <tr>
                                <td>' . ($totalPositiveFoodCash) * 200 . '</td>
                                <td>' . ($totalNegetiveFoodCash) * 200 . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <td>Positive</td>
                                <td>Negetive</td>
                            </tr>
                            <tr>
                                <td>' . ($totalPositivePayoutCash) * 200 . '</td>
                                <td>' . ($totalNegetivePayoutCash) * 200 . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <td>Positive</td>
                                <td>Negetive</td>
                            </tr>
                            <tr>
                                <td>' . ($totalPositiveFoodCash + $totalPositivePayoutCash) * 200 . '</td>
                                <td>' . ($totalNegetiveFoodCash + $totalNegetivePayoutCash) * 200 . '</td>
                            </tr>
                        </table>
                    </td>
                    <td>' . array_sum($registeredMembers) . '</td>
                </tr>';

        $html .= '</table>';

        return $html;
    }

    public function getMembersFinancialRecordWithDate(Request $request)
    {
        $date = $request->date;

        $date_start = trim(explode('-', $request->date)[0]);
        $date_start = str_replace('/', '-', $date_start);

        $date_end = trim(explode('-', $request->date)[1]);
        $date_end = str_replace('/', '-', $date_end);

        $stages = DB::table("member_table")->select('stage')->whereBetween('joindate', array($date_start, $date_end))->distinct()->orderBy('stage', 'asc')->get();

        $registeredMembers = [];
        $currentamount = [];

        foreach ($stages as $key => $st) {

            $stage = $st->stage;

            // Get the total number of registred users in a stage
            $tmp_reg_members = DB::table("member_table")->where('stage', $stage)->whereBetween('joindate', array($date_start, $date_end))->count();
            array_push($registeredMembers, $tmp_reg_members);

            // Get the total number of registred users in a stage
            $results = DB::select(DB::raw("select sum(tempcurrentamount.foodcash) as foodcash, sum(tempcurrentamount.payoutcash) as payoutcash from member_table join tempcurrentamount on tempcurrentamount.userid = member_table.membershipid where member_table.joindate BETWEEN :date_start AND :date_end AND  member_table.stage = :stage"), array(
                'date_start' => $date_start,
                'date_end' => $date_end,
                'stage' => $stage,
            ));

            array_push($currentamount, $results);
        }

        $totalFoodCash = 0;
        $totalPayoutCash = 0;
        $html = '';
        $html = '';
        $html .= '<div class="box box-default page-break"><div class="box-header"><h3 class="box-title"><div class="text-center"><h2>feed the nations </h2><div class="box-body">';
        $html .= '<table class="table table-striped table-bordered">';
        $html .= '<div><h3>Members and Financial Records Between  ' . date_format(date_create($date_start), "d-M-Y") . ' And ' . date_format(date_create($date_end), "d-M-Y") . '<br> Printed On ' . date("l, F d, o") . '</h3></div>';

        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th>Stage</th><th>Food Cash</th><th>Payout Cash</th><th>Food and Cash</th><th>Registered Members</th></tr>';
        foreach ($stages as $key => $st) {
            $totalFoodCash += $currentamount[$key][0]->foodcash;
            $totalPayoutCash += $currentamount[$key][0]->payoutcash;
            $stage = $st->stage;
            $html .= '<tr><td>' . $stage . '</td><td>' . $currentamount[$key][0]->foodcash * 200 . '</td><td>' . $currentamount[$key][0]->payoutcash * 200 . '</td><td>' . ($currentamount[$key][0]->foodcash + $currentamount[$key][0]->payoutcash) * 200 . '</td><td>' . $registeredMembers[$key] .
                '</td></tr>';
        }
        $html .= '<tr><td><b>Total</b></td><td>' . $totalFoodCash * 200 . '</td><td>' . $totalPayoutCash * 200 . '</td><td>' . ($totalFoodCash + $totalPayoutCash) * 200 . '</td><td>' . array_sum($registeredMembers) .
            '</td></tr>';

        $html .= '</table>';

        return $html;
    }

    // New Added On 23-05-2019 By Mesh Manuel
    public function generateReportForAmountGainedByDeduction(Request $request)
    {

        $stages = DB::table("member_table")->select('stage')->distinct()->orderBy('stage', 'asc')->get();

        $positiveAccounts = DB::select(DB::raw(
            "SELECT
                m.stage,
                count(*) as Members,
                SUM(t.payoutcash) as TotalPayoutCash,
                SUM(t.foodcash) as TotalFoodcash,
                SUM(t.payoutcash + t.foodcash) - SUM((t.payoutcash + t.foodcash) - 2) as AmountGained,
                SUM((t.payoutcash + t.foodcash) - 2) as Balance
            FROM member_table m
            JOIN tempcurrentamount t
                on t.userid = m.membershipid
            WHERE (t.payoutcash + t.foodcash) > 2  AND m.stage > 0
            GROUP BY m.stage"
        ));

        $negetiveAccounts = DB::select(DB::raw(
            "SELECT
                m.stage,
                count(*) as Members,
                SUM(t.payoutcash) as TotalPayoutCash,
                SUM(t.foodcash) as TotalFoodcash,
                SUM(t.payoutcash + t.foodcash) - SUM((t.payoutcash + t.foodcash) - 2) as AmountGained,
                SUM((t.payoutcash + t.foodcash) - 2) as Balance
            FROM member_table m
            JOIN tempcurrentamount t
                on t.userid = m.membershipid
            WHERE (t.payoutcash + t.foodcash) <= 2  AND m.stage > 0
            GROUP BY m.stage"
        ));

        $positiveAccounts = (array) $positiveAccounts;
        $negetiveAccounts = (array) $negetiveAccounts;

        $html = '';
        $html .= '<div class="box box-default page-break"><div class="box-header"><h3 class="box-title"><div class="text-center"><h2>feed the nations </h2><div class="box-body">';
        $html .= '<table class="table table-striped table-bordered">';
        $html .= '<div><h3>Report For Amount Gained By Deduction Printed On ' . date("l, F d, o") . '</h3></div>';

        $html .= '<table class="table table-bordered">';

        $html .= '<tr><td colspan="6">Positive Accounts</td></tr>';
        $html .= '<tr><th>Stage</th><th>Members</th><th>Total FoodCash</th><th>Total PayoutCash</th><th>Amount Gained</th><th>Balance</th></tr>';

        $totalMembers = 0;
        $totalFoodcash = 0;
        $totalPayoutcash = 0;
        $totalAmountGained = 0;
        $totalBalance = 0;

        foreach ($positiveAccounts as $key => $positive) {

            $totalMembers += (float) $positiveAccounts[$key]->Members;
            $totalFoodcash += (float) $positiveAccounts[$key]->TotalFoodcash;
            $totalPayoutcash += (float) $positiveAccounts[$key]->TotalPayoutCash;
            $totalAmountGained += (float) $positiveAccounts[$key]->AmountGained;
            $totalBalance += (float) $positiveAccounts[$key]->Balance;

            $html .= '<tr>
                    <td>' . $positiveAccounts[$key]->stage . '</td>
                    <td>' . $positiveAccounts[$key]->Members . '</td>
                    <td>' . $positiveAccounts[$key]->TotalFoodcash * 200 . '</td>
                    <td>' . $positiveAccounts[$key]->TotalPayoutCash * 200 . '</td>
                    <td>' . $positiveAccounts[$key]->AmountGained * 200 . '</td>
                    <td>' . $positiveAccounts[$key]->Balance * 200 . '</td>
                </tr>';
        }

        $html .= '<tr>
                <td><b>Total</b></td>
                <td><b>' . $totalMembers . '</b></td>
                <td><b>' . $totalFoodcash * 200 . '</b></td>
                <td><b>' . $totalPayoutcash * 200 . '</b></td>
                <td><b>' . $totalAmountGained * 200 . '</b></td>
                <td><b>' . $totalBalance * 200 . '</b></td>
            </tr>';

        $html .= '<tr><td colspan="6"></td></tr>';
        $html .= '<tr><td colspan="6"></td></tr>';
        $html .= '<tr><td colspan="6">Negetive Accounts</td></tr>';
        $html .= '<tr><th>Stage</th><th>Members</th><th>Total FoodCash</th><th>Total PayoutCash</th><th>Amount Gained</th><th>Balance</th></tr>';

        $totalMembers = 0;
        $totalFoodcash = 0;
        $totalPayoutcash = 0;
        $totalAmountGained = 0;
        $totalBalance = 0;

        foreach ($negetiveAccounts as $key => $positive) {

            $totalMembers += (float) $negetiveAccounts[$key]->Members;
            $totalFoodcash += (float) $negetiveAccounts[$key]->TotalFoodcash;
            $totalPayoutcash += (float) $negetiveAccounts[$key]->TotalPayoutCash;
            $totalAmountGained += (float) $negetiveAccounts[$key]->AmountGained;
            $totalBalance += (float) $negetiveAccounts[$key]->Balance;

            $html .= '<tr>
                    <td>' . $negetiveAccounts[$key]->stage . '</td>
                    <td>' . $negetiveAccounts[$key]->Members . '</td>
                    <td>' . $negetiveAccounts[$key]->TotalFoodcash * 200 . '</td>
                    <td>' . $negetiveAccounts[$key]->TotalPayoutCash * 200 . '</td>
                    <td>' . $negetiveAccounts[$key]->AmountGained * 200 . '</td>
                    <td>' . $negetiveAccounts[$key]->Balance * 200 . '</td>
                </tr>';
        }

        $html .= '<tr>
                <td><b>Total</b></td>
                <td><b>' . $totalMembers . '</b></td>
                <td><b>' . $totalFoodcash * 200 . '</b></td>
                <td><b>' . $totalPayoutcash * 200 . '</b></td>
                <td><b>' . $totalAmountGained * 200 . '</b></td>
                <td><b>' . $totalBalance * 200 . '</b></td>
            </tr>';

        $html .= '</table>';

        return $html;
    }

    ###################################################################################################################################################

    public function fixIssues(Request $request)
    {
        set_time_limit(0);
        $this->getAllMembersByStage($request->id);
        dump("The End");
    }

    public function getAllMembersByStage($stage)
    {
        DB::beginTransaction();

        try {

            $members = DB::select("SELECT mu.matrix_id, mx.ownerid as membershipid, mx.type_id, mu.position FROM matrix mx LEFT JOIN matrix_users mu on mx.matrix_id = mu.matrix_id WHERE mx.type_id = :stage and mx.count_users < (select count(*) from matrix_users where matrix_id = mx.matrix_id and user_id <> '0') GROUP BY mx.matrix_id LIMIT 100", ['stage' => $stage]);

            foreach ($members as $member) {
                print_r($member->membershipid);
                echo "<br>";
            }

            foreach ($members as $member) {

                $membershipID = $member->membershipid;

                $matrix_count = $this->get_matrix_count($membershipID);

                if (!empty($matrix_count)) {

                    $count_difference = (int) $matrix_count["matrix_users_count"] - (int) $matrix_count["matrix_count"];

                    dump($member->membershipid . " has incomplete matrix count. " . "Matrix Count: " . $matrix_count["matrix_count"] . " Matrix Users Count: " . $matrix_count["matrix_users_count"] . ". Count Difference: " . $count_difference);

                    $data_from_matrix_users_tbl_lmt = DB::select('select * from matrix_users where matrix_id = :id and user_id <> :uid and position = "L" limit :cid', ['id' => $matrix_count["matrix_id"], 'uid' => 0, 'cid' => $count_difference]);

                    dump("Matrix ID from Query: " . $member->matrix_id);
                    dump("Matrix ID from tbl_lmt: " . $matrix_count["matrix_id"]);

                    $newDepth6to20 = $this->graphdb->getMembersFromNewDepth($membershipID, $stage);

                    foreach ($data_from_matrix_users_tbl_lmt as $key => $user) {
                        if (!in_array($user->user_id, $newDepth6to20)) {

                            // Pay user full payment
                            if ($count_difference > 0) {

                                if ($stage == 1) {
                                    dump("Pay  full " . $membershipID . ": $16");
                                    DB::update("update tempcurrentamount set foodcash = foodcash + 16 where userid = :id", ['id' => $membershipID]);
                                }

                                // if($stage == 2){
                                //     dump("Pay  full " . $membershipID . ": $40");
                                //     DB::update("update tempcurrentamount set foodcash = foodcash + 40 where userid = :id", ['id' =>$membershipID]);
                                // }

                                // if($stage == 3){
                                //     dump("Pay full  " . $membershipID . ": $50");
                                //     DB::update("update tempcurrentamount set foodcash = foodcash + 50 where userid = :id", ['id' =>$membershipID]);
                                // }

                                // if($stage == 4){
                                //     dump("Pay full " . $membershipID . ": $160");

                                //     DB::update("update tempcurrentamount set foodcash = foodcash + 160 where userid = :id", ['id' =>$membershipID]);
                                //     // DB::table("tempcurrentamount")->where("useri", $membershipID)->increment('foodcash', 160);
                                // }
                            }

                        } else {

                            // Pay user half payment
                            if ($count_difference > 0) {

                                if ($stage == 1) {
                                    dump("Pay  half " . $membershipID . ": $8");
                                    DB::update("update tempcurrentamount set foodcash = foodcash + 8 where userid = :id", ['id' => $membershipID]);
                                }

                                // if($stage == 2){
                                //     dump("Pay  half " . $membershipID . ": $20");
                                //     DB::update("update tempcurrentamount set foodcash = foodcash + 20 where userid = :id", ['id' =>$membershipID]);
                                // }

                                // if($stage == 3){
                                //     dump("Pay  half " . $membershipID . ": $25");
                                //     DB::update("update tempcurrentamount set foodcash = foodcash + 25 where userid = :id", ['id' =>$membershipID]);
                                // }

                                // if($stage == 4){
                                //     dump("Pay half " . $membershipID . ": $80");
                                //     DB::update("update tempcurrentamount set foodcash = foodcash + 80 where userid = :id", ['id' =>$membershipID]);
                                // }
                            }
                        }
                    }
                    if ($count_difference > 0) {
                        dump("Update " . $member->matrix_id . " matrix count with: " . $count_difference);
                        // DB::table("matrix")->where("matrix_id", $member->matrix_id)->increment('count_user', $count_difference);
                        DB::update('update matrix set count_users = count_users + ? where matrix_id = ?', [$count_difference, $member->matrix_id]);
                    }
                }

                dump($membershipID . " has been PAID!");
                dump("----------------------------------------------------------------------------------------------------------------");
            }

            // IF NOT QUERY FAILS, COMMIT TRANSACTION
            DB::commit();
            dump("All Data Submitted");

            // all good
        } catch (\Exception $e) {
            DB::rollback();

            dump("Something went wrong" . $e);
            // something went wrong
        }
    }

    public function get_matrix_count($membershipID)
    {
        // Get Current Stage
        $stage = DB::table("member_table")->where("membershipid", $membershipID)->first()->stage;

        $data_from_matrix_tbl = DB::select('select * from matrix where ownerid = :id ORDER BY matrix_id', ['id' => $membershipID]);
        // $data_from_matrix_tbl = DB::select('select * from matrix where ownerid = :id ORDER BY matrix_id DESC LIMIT 1', ['id' => $membershipID]);

        $tmp_count = count($data_from_matrix_tbl);

        $matrix_id = $data_from_matrix_tbl[$tmp_count - 1]->matrix_id;
        $data_from_matrix_users_tbl = DB::select('select * from matrix_users where matrix_id = :id and user_id <> :uid', ['id' => $matrix_id, 'uid' => 0]);

        if ((int) $data_from_matrix_tbl[$tmp_count - 1]->count_users != count($data_from_matrix_users_tbl)) {
            return ["matrix_count" => (int) $data_from_matrix_tbl[$tmp_count - 1]->count_users, "matrix_users_count" => count($data_from_matrix_users_tbl), "matrix_id" => $matrix_id];
        } else {
            return [];
        }
    }

    // ------------------------------------------------
    // ------------------------------------------------
    public function getStageThreePinIndex()
    {
        return view('stagethreepin.index');
    }

    // PHP EXEC TEST
    public function testExec()
    {
        $output = shell_exec('ls -lart');
        echo "<pre>$output</pre>";
    }
}
