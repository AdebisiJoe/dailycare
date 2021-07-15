<?php

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
    Route::post('register/user','RegistrationApiController@registerUser');

    Route::post('logout/user','AuthenticateController@logoutUser');

    Route::post('getuserwalletbalance','UserApiController@getWalletBalance');
    Route::post('getusertotalordersmade','UserApiController@registerUser');
    Route::post('getusertotalnumberofreferred','UserApiController@getTotalNumberOfReferred');
    Route::post('getusertotalnumberOfdownlines','UserApiController@getTotalNumberOfDownlines');
    Route::post('getuserdetails','UserDetailsController@getUserDetails');

    Route::post('getuserreferrals','UserApiController@getReferrals');

    Route::post('getusermatrixmembers','GenealogyApiController@getMatrixMembers');


    Route::post('getsingleuserrecord','UserApiController@getSingleMemberRecord');


    Route::post('getallmembers','UserApiController@getAllMembers');

    Route::post('createticket','TicketApiContoller@createTicket');

    Route::post('usertickets','TicketApiContoller@userTicketList');

    Route::post('ticketsthread','TicketApiContoller@viewTicketComments');

    Route::post('postcomment','TicketApiContoller@postComment');

    Route::post('releasewalletlock','EwalletApiController@releaseWalletLock');

    Route::post('checkmembershipidavailability','RegistrationApiController@checkIfMembershipIdExist');

   Route::post('getsubaccounts','SubaccountApiController@getSubAccounts');

    // include 'foodcollectionroutes.php';
    include 'profileapiroutes.php';
    include 'geneologyapiroutes.php';

    //Ewallet api routes

    Route::post('getnumberoftransactions','EwalletApiController@numberOfTransactions');

    Route::post('transferfunds','EwalletApiController@transferFunds');

    Route::post('getalltransactions','EwalletApiController@getTransactions');

    Route::post('useraccountsummary','EwalletApiController@accountSummary');



    Route::post('checkifusernamealreadyexist','RegistrationApiController@checkUsernameAvailability');



    //webviewapirpoutes

    Route::get('usermatrix/{membershipid}','MatrixApiController@matrixTree');

});