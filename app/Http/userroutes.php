<?php

//user account routes
Route::group(['middleware' => ['lock']], function () {

     // Route::get('/home',[
    //     'uses'=>'userController@showUserDashboard',
    //     'as'=>'home2',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ]);
    Route::get('/transfer', 'accountcontroller@viewtransfermoney');
    Route::get('/accountdashboard', 'accountcontroller@showdashboard');
    Route::get('/transfercash', 'accountcontroller@showdashboard');
    Route::get('/transferpayoutcashfromfoodcash', 'accountcontroller@showTransferFromPayoutToFood');
    Route::post('/transferpayoutcashfromfoodcash', 'accountcontroller@transferFromPayoutToFood');
    Route::get('/viewtransactions', 'accountcontroller@viewtansactions');
    Route::get('/fundaccount', 'accountcontroller@viewfundaccount');
    Route::get('/payoutcash', 'accountcontroller@viewpayout');
    Route::post('/payoutcash', 'accountcontroller@payoutcash');
    Route::get('/accountbalance', 'accountcontroller@showaccountdetails');
    Route::post('/transfercash', 'accountcontroller@transfermoney');

});

Route::get('/accountbalance','accountcontroller@showaccountdetails');
Route::get('/showaccountdetails','accountcontroller@showaccountdetails');
Route::get('/showaccountdetails/{membershipid}', 'SubaccountController@Showsubaccountwalletdetails');
Route::get('/subaccounttranfertofoodcash/{membershipid}', 'SubaccountController@showSubAccountTranfertoFoodcash');
Route::post('/subaccounttranfertofoodcash', 'SubaccountController@SubAccountTranfertoFoodcash');
Route::post('/showaccount','LockScreenController@gotoaccount');

Route::get('/showlock','LockScreenController@showlock');



//userprofile
Route::get('/viewprofile','UserController@showprofile');
//Route::get('/viewprofile','UserController@editprofile');
Route::get('/editpersonalinfo','UserController@showeditpersonalinfo');
Route::post('/editpersonalinfo','UserController@editpersonalinfo');
Route::get('/editbankinfo','UserController@showeditbankinfo');
Route::post('/editbankinfo','UserController@editbankinfo');
Route::get('/changepassword','UserController@showeditpasswordinfo');
Route::post('/changepassword','UserController@editpasswordinfo');
Route::post('/uploadprofilepic','UserController@updateprofile');
Route::post('/acceptTerms', array('as'=>'acceptTerms','uses'=>'UserController@setAcceptTerms'));


//user members tree
//showmembertreepage
Route::get('/getthejson','UserController@drawstage1tree');
Route::get('/showmemberstree','UserController@showmembertreepage');
Route::get('/showmemberstable','UserController@showmemberstablepage');

Route::get('/members-chart-init',array('as'=>'members-chart-init','uses'=>'UserController@sendusermemberstreeinitialdata'));
Route::get('/members-chart-init2/{membershipid}',array('as'=>'members-chart-init2','uses'=>'UserController@searchifuserisdownline'));
Route::get('/members-chart-children/{membershipid}',array('as'=>'members-chart-children','uses'=>'UserController@sendchildrenchildrendata'));


//user award routes

Route::get('/awards', 'AwardUserController@index');

Route::get('/viewawardproduct/{id}','AwardUserController@show');

Route::get('/requestawardproduct/{id}/{membershipid}','AwardUserController@requestawardformainaccount');

