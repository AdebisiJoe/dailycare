<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;


class PaymentPluginController extends Controller
{

    public function getStatus(Request $request, $mertid, $order_id)
    {
        // $request = 'mertid='.$mertid.'&transref='.$transref.'&respformat='.$type.'&signature='.$sign; //initialize the request variables
        //$request='transaction_ref&order_ID&amount &payment_gate&response_code&currency_code& merchant_ID &date_time';
        $request = "";
        $curl = curl_init("https://fidelitypaygate.fidelitybankplc.com/cipg/MerchantServices/UpayTransactionStatus.ashx?MERCHANT_ID=05062&ORDER_ID=$order_id");

        curl_setopt($curl, CURLOPT_VERBOSE, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        $response = curl_exec($curl);
//echo htmlspecialchars($response);
//echo "<pre>"; print_r($response); echo "</pre>";
        curl_close($curl);

        $result = simplexml_load_string($response);

//echo $arr_result->StatusCode;


        return $result;

//$xml = simplexml_load_string($data);
//print_r($xml);
//$arr_result = (array)simplexml_load_string($data);
//return json_decode(json_encode($arr_result));

    }

    public function callback($merchantid, $sale_id)
    {
        $response = getStatus($merchantid, $sale_id);
        $status_code = $response->StatusCode;
        $status_message = $response->Status;

        $transref = $response->TransactionRef;

    }






public  function sendTransactionRequestToGtPay()
{
    //1. SENDING TRANSACTION REQUESTS TO GTPay

//This is the GTPay-wide unique identifier of merchant, assigned by //GTPay and communicated to merchant by GTBank after merchant //registration. $gtpay_mert_id = "";
// The code used to denote the currency in which transaction was //carried out (566 or 844) $gtpay_tranx_curr = "";
//The total monetary value of transaction in Naira or Dollars (not in //kobo or cents as sent in the transaction request) $gtpay_tranx_amt = "";
// The merchant-wide unique transaction identifier, sent by merchant in //the transaction request sent $gtpay_tranx_id = "";
    $gtpay_cust_name = ""; //Name of the customer
    $gtpay_tranx_noti_url = ""; //url for transaction notification
//Will be provided on setup. Please keep the value secure $hashkey = "";
// The merchant-wide unique identifier for the payer $gtpay_cust_id = "";
// The miscellaneous data merchant sent earlier and wants returned at
//transaction completion
    $gtpay_echo_data = "";
// The name of the gateway that serviced transaction. This will be //either webpay, migs or ibank
$gtpay_gway_name = "";
// This describes the transaction to the customer. For example,
//gtpay_tranx_memo = "John Adebisi (REG13762) : 2nd Term School Fees
//Payment"
//If not sent, "Purchase from [Business-Name-Of-Merchant]" will be //used
$gtpay_tranx_memo = "";
// Merchants are required to perform a sha512* hash of
//[gtpay_mert_id,gtpay_tranx_id,gtpay_tranx_amt,gtpay_tranx_curr,gtp
//ay_cust_id,gtpay_tranx_noti_url,hashkey]
//$gtpay_hash=$gtpay_mert_id.$gtpay_tranx_id.$gtpay_tranx_amt.$gtpay_tranx_curr.$gtpay_cust_id.$gtpay_tranx_noti_url.$hashkey;
//$gtpay_hash = $hashed = hash('sha512', $gtpay_hash);

}
//2. RECEIVING TRANSACTION STATUS FROM GTPAY


public function fillFormWithDataGoingToGtPay(Request $request)
{
    $noOfPins=$request->noOfPins;
    $customerEmail=$request->customerEmail;

}

public function captureUserRecords(Request $request){

    $validator=Validator::make($request->all(),
        [
            'name' => 'required|alpha_num|max:255|min:4',
            'email'=>'required|email',
            'phonenumber'=>'required',
            'noofpins'=>'required|numeric',
        ]);
//take actions when the validation has failed
    if ($validator->fails()){
        return redirect('/buypin')
            ->withErrors($validator)
            ->withInput();
    }


    $name=trim($request->name);
    $email=trim($request->email);
    $phonenumber=trim($request->phonenumber);
    $noofpins=trim($request->noofpins);

    //1. SENDING TRANSACTION REQUESTS TO GTPay

//This is the GTPay-wide unique identifier of merchant, assigned by //GTPay and communicated to merchant by GTBank after merchant //registration.
   $gtpay_mert_id = "7577";

// The code used to denote the currency in which transaction was //carried out (566 or 844)
  $gtpay_tranx_curr = "566";

//The total monetary value of transaction in Naira or Dollars (not in //kobo or cents as sent in the transaction request)
    $totalamountinnaira=$noofpins*6500;
   $gtpay_tranx_amt =$this->getAmountInKobo($noofpins);
// The merchant-wide unique transaction identifier, sent by merchant in //the transaction request sent
    $gtpay_tranx_id =$this->generateUniqueTransactionId();

    //Name of the customer
    $gtpay_cust_name =$name;

    //url for transaction notification
    //$gtpay_tranx_noti_url = "https://feedthenations.org/proceessusertransaction";

    //$gtpay_tranx_noti_url ="http://localhost/mywebsites/laravelMLM/public/proceessuserpaymenttransaction";

    $gtpay_tranx_noti_url="";



//Will be provided on setup. Please keep the value secure
  $hashkey="D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";

// The merchant-wide unique identifier for the payer
   $gtpay_cust_id =$this->generateCustomerId();
  // dd($gtpay_cust_id);

// The miscellaneous data merchant sent earlier and wants returned at
//transaction completion
    $gtpay_echo_data =$name."(".$gtpay_cust_id.")".":Payment for ".$noofpins." number of Pins";

// The name of the gateway that serviced transaction. This will be //either webpay, migs or ibank
    $gtpay_gway_name = "webpay";

// This describes the transaction to the customer. For example,
//gtpay_tranx_memo = "John Adebisi (REG13762) : 2nd Term School Fees
//Payment"
//If not sent, "Purchase from [Business-Name-Of-Merchant]" will be //used
    $gtpay_tranx_memo = $name."(".$gtpay_cust_id.")".":Payment for ".$noofpins." number of Pins";

// Merchants are required to perform a sha512* hash of
//[gtpay_mert_id,gtpay_tranx_id,gtpay_tranx_amt,gtpay_tranx_curr,gtp
//ay_cust_id,gtpay_tranx_noti_url,hashkey]


    $gtpay_hash =$this->generateHash($gtpay_mert_id,$gtpay_tranx_id,$gtpay_tranx_amt,$gtpay_tranx_curr,$gtpay_cust_id,$gtpay_tranx_noti_url,$hashkey);

    $gtpay_hash=trim($gtpay_hash);


    //{{$gtpay_cust_name}}{{$cust_email}}{{$cust_phonenumber}}{{$noofpins}}{{$totalamount}}

   DB::table('online_payment')->insert(['cust_name' => $gtpay_cust_name,'cust_email'=>$email,'phonenumber' => $phonenumber,'no_of_pins'=>$noofpins,'trans_amount'=>$totalamountinnaira,'cust_id' =>$gtpay_cust_id,'trans_id' => $gtpay_tranx_id,'hash' => $gtpay_hash,'responsecode' => 0,'comment' => 0]);


    return view('website3.pinpurchase.customerbuypinformtogtpay')->with(['gtpay_cust_name'=>$gtpay_cust_name,'cust_email'=>$email,'cust_phonenumber'=>$phonenumber,'noofpins'=>$noofpins,'totalamountinnaira'=>$totalamountinnaira,'gtpay_mert_id'=>$gtpay_mert_id,'gtpay_tranx_id'=>$gtpay_tranx_id,'gtpay_tranx_amt'=>$gtpay_tranx_amt,'gtpay_tranx_curr'=>$gtpay_tranx_curr,'gtpay_cust_id'=>$gtpay_cust_id,'gtpay_tranx_noti_url'=>$gtpay_tranx_noti_url,'hashkey'=>$gtpay_hash,'gtpay_tranx_memo'=>$gtpay_tranx_memo,'gtpay_echo_data'=>$gtpay_echo_data,'gtpay_gway_name'=>$gtpay_gway_name,'gtpay_tranx_hash'=>$gtpay_hash]);

}

public function processPaymentInformation(Request $request)
{
    $gtpay_mert_id = "";
    $gtpay_tranx_id = $_REQUEST['gtpay_tranx_id'];
    $gtpay_tranx_amt_small_denom = $_REQUEST['gtpay_tranx_amt_small_denom'];
    $gtpay_tranx_status_code = $_REQUEST['gtpay_tranx_status_code'];
    $gtpay_tranx_curr = $_REQUEST['gtpay_tranx_curr'];
    $gtpay_tranx_amt = $_REQUEST['gtpay_tranx_amt'];
    $hashkey = "";
    $gtpay_full_verification_hash = $_REQUEST['gtpay_full_verification_hash'];
    $your_verification_harsh = $gtpay_tranx_id.$gtpay_tranx_amt_small_denom.$gtpay_tranx_status_code.$gtpay_tranx_curr.$hashkey;
    $your_verification_harsh = hash('sha512', $your_verification_harsh);
    $gtpay_full_verification_hash = strtolower($gtpay_full_verification_hash);
    $your_verification_harsh = strtolower($your_verification_harsh);

   //Compare to ensure verification harsh matches
    if($gtpay_full_verification_hash == $your_verification_harsh) {
//confirm trassaction authenticity from GT Webservice

        $hash_req = hash('sha512', $gtpay_mert_id . $gtpay_tranx_id . $hashkey);

//Parameters to send to GT WebService
//mertid, amount, tranxid, hash
$params = "mertid=".$gtpay_mert_id."&amount=".$gtpay_tranx_amt_small_denom."&tranxid=".$gtpay_tranx_id."&hash=".$hash_req;

//Use e.g PHP Curl library to send request and get result
        $url = 'https://ibank.gtbank.com/GTPayService/gettransactionstatus.json?' . $params;
        $result= getProcessedResult($url);
//Send request to GTWebService
        $result = json_decode($result, true);
        if ($result['ResponseCode'] == '00') { //If Successful
//Check for detailed response from webservice and process e.g
            $result['TransactionCurrency'];
            $result['Amount'];
            $result['MertID'];

        }else{
            return "transaction failed";
        }

    }
}

public function getProcessedResult($url)
{
    // $request = 'mertid='.$mertid.'&transref='.$transref.'&respformat='.$type.'&signature='.$sign; //initialize the request variables
    //$request='transaction_ref&order_ID&amount &payment_gate&response_code&currency_code& merchant_ID &date_time';
    $request = "";
    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_VERBOSE, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
    curl_setopt($curl, CURLOPT_TIMEOUT, 0);
    $response = curl_exec($curl);
//echo htmlspecialchars($response);
//echo "<pre>"; print_r($response); echo "</pre>";
    curl_close($curl);

    //$result = simplexml_load_string($response);

//echo $arr_result->StatusCode;
    //return json_decode(json_encode($response));

    return $response;

//$xml = simplexml_load_string($data);
//print_r($xml);
//$arr_result = (array)simplexml_load_string($data);
//return json_decode(json_encode($arr_result));
}

public function generateCustomerId()
{
    $lastid = $this->getlastid();
     $string ='CUHWMGP_';


   return  $string=$string.$lastid;
}

public  function generateHash($gtpay_mert_id,$gtpay_tranx_id,$gtpay_tranx_amt,$gtpay_tranx_curr,$gtpay_cust_id,$gtpay_tranx_noti_url,$hashkey)
{
    $gtpay_hash=$gtpay_mert_id.$gtpay_tranx_id.$gtpay_tranx_amt.$gtpay_tranx_curr.$gtpay_cust_id.$gtpay_tranx_noti_url.$hashkey;
   return  $hashed = hash('sha512',$gtpay_hash,false);
}

public function getAmountInKobo($noofpins)
{
    $amountInKobo=6500*$noofpins*100;

    return $amountInKobo;
}


    public function  generateUniqueTransactionId()
    {
        $lastid = $this->getlastid();
        $string = 'PHWMGP_';

//     $countstring=strlen($lastid);
        $number = 11000;
        $number += $lastid;
        $countstring1 = strlen($number);

        if ($countstring1 == 5) {
            # code...
            $string .= '000' . $number;
        } elseif ($countstring1 == 6) {
            # code...
            $string .= '00' . $number;
        } elseif ($countstring1 == 7) {
            # code...
            $string .= '0' . $number;
        } else {
            # code...
            $string .= $number;
        }

        return $string;
    }

    public function getlastid(){
        $lastid=DB::select('select max(id) as maxID from online_payment');

    //echo $lastid->maxID;
        foreach ($lastid as $key => $v) {
            # code...
            $lastid=$v->maxID;
        }
        if ($lastid==null) {
            # code...
            return 1;
        } else {
            # code...
            return  $lastid+1;
        }

    }



}
