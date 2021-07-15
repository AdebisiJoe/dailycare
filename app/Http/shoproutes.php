<?php
Route::group(['middleware' => ['shopadminlock']], function () {

     // Route::get('/home',[
    //     'uses'=>'userController@showUserDashboard',
    //     'as'=>'home2',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ]);

    //json for calculate re per day

    //calculateTotalRegisteredPerDay
    Route::get('/calculatetotalregisteredperday','AnalyticsController@calculateTotalRegisteredPerDay');

    //changetransactionpassword

    Route::get('/showchangetransactionpassword','AdminController@showChangeTransactionPassword');
    Route::post('/showchangetransactionpassword','AdminController@changeTransactionPassword');

    //Pin Request system
    Route::get('/subadminpinrequest','PingenerationController@showSubAdminPinRequestPage');
    Route::post('/subadminpinrequest','PingenerationController@subAdminPinRequest');
    Route::get('/showuserpinrequest','PingenerationController@showAllPinsReqestedByUser');

//ticket admin
    Route::get('tickets', 'TicketsController@index');
    Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
    Route::post('re_open_ticket/{ticket_id}', 'TicketsController@re_open');
    Route::post('search_tickets', 'TicketsController@userTicketsSearch');

//food collection
    Route::post('/getavailableamount',array('as'=>'getAvailableAmount','uses'=>'GoodsCollectionController@getAvailableAmount'));

    Route::post('/setnewamount',array('as'=>'setNewAmount','uses'=>'GoodsCollectionController@setNewAmount'));

    Route::post('/getcollectionlog',array('as'=>'getcollectionlog','uses'=>'GoodsCollectionController@getUserLog'));

//good collection routes
    Route::get('/goods-collection', function() {
        return view('goodscollection.index');
    });
    //change password routes
    Route::post('/adminchangepassword',array('as'=>'adminchangepassword','uses'=>'AdminController@changeuserpassword'));
    Route::get('/showchangepassword','AdminController@showchangeuserpasswordpage');
    Route::get('/admin-operation', 'AdminOperationController@getParentIndex');
    Route::get('/admin-operation/get-userinfo', 'AdminOperationController@getuserInfo');
    Route::get('/admin-operation/get-parent', 'AdminOperationController@getParent');
    Route::get('/admin-operation/get-pin', 'AdminOperationController@getPIN');
    Route::get('/admin-operation/get-pin-status', 'AdminOperationController@getPINStatus');

    Route::get('/admin-operation/get-downlines', 'AdminOperationController@getDownlines');
    Route::get('/admin-operation/get-matrix', 'AdminOperationController@getMatrix');
    Route::get('/admin-operation/get-products', 'AdminOperationController@getProducts');
    Route::get('/admin-operation/update-prod-info', 'AdminOperationController@updateProductInfo');
    Route::get('/admin-operation/get-user-account-balance', 'AdminOperationController@getUserAccountBalance');
    Route::get('/admin-operation/get-user-food-collection-log', 'AdminOperationController@getUserFoodCollectionLog');
    Route::get('/admin-operation/get-groups', 'FoodCollectionController@getGroups');

    Route::get('/food-collection/reports', function () {
        return view('foodcollection.report');
    });
    Route::get('/food-collection/reports/generate', 'FoodCollectionController@reportGenerator');
    Route::get('/food-collection/get_groups', 'FoodCollectionController@getGroups');
    Route::get('/food-collection/groups', 'FoodCollectionController@getProducts');
    Route::get('/food-collection/groups/create', 'FoodCollectionController@getProducts');
    Route::get('/food-collection/groups/save', 'FoodCollectionController@createGroup');
    Route::post('/food-collection/groups/delete', 'FoodCollectionController@deleteGroup');
    Route::post('/food-collection/groups/update', 'FoodCollectionController@updateGroup');
    Route::get('/food-collection/groups/list', 'FoodCollectionController@listGroup');
    Route::get('/food-collection/group', function() {
        return view('foodcollection.group');
    });
});