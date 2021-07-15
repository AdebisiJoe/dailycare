<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;

class MainAccountSubAccount extends Controller
{
    public function index()
    {
        ini_set('max_execution_time', 0);
        $this->calculate();

    }

    public function calculate()
    {
        dump("Getting all accounts with sub account...");
        $list1 = DB::select('SELECT DISTINCT isownedby FROM member_table m where m.type = "subaccount" LIMIT 20000, 10000');
        dump("*******************************************************************************************************");

        for ($i = 0; $i < count($list1); $i++) {

            // get all subaccounts
            dump("Getting all subaccounts for: " . $list1[$i]->isownedby);
            $list2 = DB::select('SELECT m.membershipid, t.foodcash, t.payoutcash from member_table m join tempcurrentamount t on t.userid = m.membershipid where m.stage > 0 and m.isownedby = "' . $list1[$i]->isownedby . '"');

            $foodcash = 0;
            $payoutcash = 0;
            if (!empty($list2)) {
                for ($k = 0; $k < count($list2); $k++) {
                    dump("Summing up subaccount balance..");
                    $foodcash += ($list2[$k]->foodcash);
                    $payoutcash += ($list2[$k]->payoutcash);

                    dump("Update " . $list2[$k]->membershipid . " with " . ($foodcash + $payoutcash));

                    $update = DB::update("update tempcurrentamount set foodcash = 0, payoutcash = 0 where userid = '" . $list2[$k]->membershipid . "'");

                    dump($list2[$k]->membershipid . ": account summed up and updated");
                }

                dump("Updating main account " . $list1[$i]->isownedby . " with " . ($foodcash + $payoutcash . "."));

                $update = DB::update("update tempcurrentamount set foodcash = foodcash + '" . ($foodcash + $payoutcash) . "' where userid = '" . $list1[$i]->isownedby . "'");

                dump("Main account updated.");
            } else {
                dump("No account updated.");
            }

            dump(($i + 1) . "-------------------------------------------------------------------------------------------");
        }

    }
}
