<?php

Route::get('/app', function () {
    return view('app');
});

Route::group(['middleware' => ['web']], function () {

    Route::get('/getfinrec/{stage}/{limit}/{offset}', 'websitecontroller@getAllMembersFinrecords');
    Route::resource('items', 'ItemController');

    Route::get('/home', 'UserController@showhome');

    // Route::get('/','WebsitePagesController@gotowebsitehome');

    Route::get('/', function () {
        return view('website3.index');
    });

//tests
    Route::get('/create', 'Matrix@create');
    Route::get('/create2', 'UserController@create');
    Route::get('jsonfortree', array('as' => 'jsonfortree', 'uses' => 'UserController@drawusertree1'));

    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('/login', function () {
        return view('website3.auth.login');
        // return view('master');
    });

    Route::get('/calculatebonus/{stage}', 'websitecontroller@CalculateBonusForStage');

    Route::get('/logout', 'Auth\AuthController@logout');

    Route::get('/show', function () {
        return view('index');
    });

    Route::get('/api/v1/employees/{id?}', 'Employees@index');
    Route::post('/api/v1/employees', 'Employees@store');
    Route::post('/api/v1/employees/{id}', 'Employees@update');
    Route::delete('/api/v1/employees/{id}', 'Employees@destroy');
//Route::get('register','Employees@showregister');

//Route::get('/accounts','UserController@');
    Route::get('/showregister', 'UserController@showregister');
    Route::get('/printdate', 'UserController@getuniqueid');

    Route::get('/matrixfiller', 'websitecontroller@matrixfiller');

    // Open API to get all products added on 29/01/2019 by Emmanuel
    Route::get('/api/all_products/{country}', 'ProductsController@getProducts');
    Route::get('/api/all_products', 'ProductsController@products');

    //Accountroutes
    // Route::get('/showaccount', ['middleware' => 'lock', function () {
    //return view('account.accountmaster');
    //}]);
    //account routes
    Route::group(['middleware' => ['lock']], function () {
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
    Route::get('/accountbalance', 'accountcontroller@showaccountdetails');
    Route::get('/showaccountdetails', 'accountcontroller@showaccountdetails');
    Route::get('/showaccountdetails/{membershipid}', 'SubaccountController@Showsubaccountwalletdetails');
    Route::get('/subaccounttranfertofoodcash/{membershipid}', 'SubaccountController@showSubAccountTranfertoFoodcash');
    Route::post('/subaccounttranfertofoodcash', 'SubaccountController@SubAccountTranfertoFoodcash');
    Route::post('/showaccount', 'LockScreenController@gotoaccount');

    Route::get('/showlock', 'LockScreenController@showlock');

//marketing tools
    Route::get('/showreferrallink', array('as' => 'showreferrallink', 'uses' => 'MarketingToolsController@index'));
    //@27/01/2017
    Route::get('/custom-post', 'MarketingToolsController@customPost');

//@20/06/2017 tickets routes added by Joseph
    /*-----------------------------------------------*/
//user routes for tickets
    Route::get('tasks', function () {
        $tasks = App\Task::all();
        // $tasks = DB::table('tasks')->latest()->get();
        return view('tasks.index', compact('tasks'));
    });
    Route::get('tasks/{id}', function ($id) {
        $task = Task::find($id);
        // $task = DB::table('tasks')->find($id);
        return view('tasks.show', compact('task'));
    });

    Route::get('/taskhome', 'TicketHomeController@index');

    Route::get('new_ticket', 'TicketsController@create');
    Route::post('new_ticket', 'TicketsController@store');

    Route::get('my_tickets', 'TicketsController@userTickets');

    Route::get('tickets/{ticket_id}', 'TicketsController@show');

    Route::post('comment', 'CommentsController@postComment');
/*----------------------------------------------*/

//administration routes
    Route::get('/viewuserstages', 'AdminController@showuserstages');

    Route::group(['middleware' => ['shopadminlock']], function () {

//changetransactionpassword
        Route::get('/showchangetransactionpassword', 'AdminController@showChangeTransactionPassword');
        Route::post('/showchangetransactionpassword', 'AdminController@changeTransactionPassword');

//pin function routes 09/07/2017 tickets routes added by Joseph
        Route::get('/subadminpinrequest', 'PingenerationController@showSubAdminPinRequestPage');
        Route::post('/subadminpinrequest', 'PingenerationController@subAdminPinRequest');
        Route::get('/showuserpinrequest', 'PingenerationController@showAllPinsReqestedByUser');
//ticket admin
        //@20/06/2017 tickets routes added by Joseph
        Route::get('tickets', 'TicketsController@index');
        Route::post('close_ticket/{ticket_id}', 'TicketsController@close');
        Route::post('re_open_ticket/{ticket_id}', 'TicketsController@re_open');
        Route::post('search_tickets', 'TicketsController@userTicketsSearch');

//food collection
        Route::post('/getavailableamount', array('as' => 'getAvailableAmount', 'uses' => 'GoodsCollectionController@getAvailableAmount'));

        Route::post('/setnewamount', array('as' => 'setNewAmount', 'uses' => 'GoodsCollectionController@setNewAmount'));

        Route::post('/getcollectionlog', array('as' => 'getcollectionlog', 'uses' => 'GoodsCollectionController@getUserLog'));
//good collection routes
        Route::get('/goods-collection', function () {
            return view('goodscollection.index');
        });
        //change password routes
        Route::post('/adminchangepassword', array('as' => 'adminchangepassword', 'uses' => 'AdminController@changeuserpassword'));
        Route::get('/showchangepassword', 'AdminController@showchangeuserpasswordpage');

//admin operation
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
        Route::get('/admin-operation/check-depth-issue', 'AdminOperationController@checkDepthIssue');
        Route::get('/admin-operation/fix-stage-one-depth-issue', 'AdminOperationController@fixStageOneDepthIssue');
        Route::get('/admin-operation/members-financial-records', 'AdminOperationController@getMembersFinancialRecord');
        Route::get('/admin-operation/members-financial-records-with-date', 'AdminOperationController@getMembersFinancialRecordWithDate');
        Route::get('/admin-operation/amount-gained-by-deduction', 'AdminOperationController@generateReportForAmountGainedByDeduction');

        Route::get('/admin-operation/reverse-food-order/{group_leader_id}', 'FoodCollectionController@reverseOrderByGroup');

        //food portal routes
        Route::get('/food-portal-operation', 'FoodPortalOperationController@index');
        Route::post('/food-portal-create-country', 'FoodPortalOperationController@addNewCountry');
        Route::get('/foodportalopen/{id}', 'FoodPortalOperationController@openPortal');
        Route::get('/foodportalclose/{id}', 'FoodPortalOperationController@closePortal');

        //
        Route::get('/system-account-details', function () {
            return view('systemaccountdetails.index');
        });

        //food collection admin routes
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
        Route::get('/food-collection/group', function () {
            return view('foodcollection.group');
        });

        Route::get('/food-collection/find-group', 'FoodCollectionController@getGroup');

        Route::get('/admin-operation/get-username', 'AdminOperationController@getUsername');
        Route::get('/admin-operation/is-username-unique', 'AdminOperationController@isUsernameUnique');
        Route::get('/admin-operation/change-username', 'AdminOperationController@changeUsername');
        Route::get('/admin-operation/get-pin-information', 'AdminOperationController@getPINInformation');
        Route::get('/admin-operation/fix-pin-issue', 'AdminOperationController@unsetUsedPIN');

    });

    Route::group(['middleware' => ['adminlock']], function () {

//admin for award system
        Route::get('/create/award/categories', 'AwardCategoryController@create');

        Route::get('/view/award/categories', 'AwardCategoryController@show');

        Route::get('/edit/award/categories/{award_id}', 'AwardCategoryController@edit');

        Route::get('/delete/award/categories/{award_id}', 'AwardCategoryController@destroy');

        Route::post('create/award/categories', 'AwardCategoryController@store');

        Route::post('update/award/categories/{award_id}', 'AwardCategoryController@update');

        Route::get('/create/award/categories/contents', 'AwardCategoryContentController@create');

        Route::get('/view/award/categories/contents', 'AwardCategoryContentController@show');

        Route::get('/edit/award/categories/contents/{award_content_id}', 'AwardCategoryContentController@edit');

        Route::get('/delete/award/categories/contents/{award_content_id}', 'AwardCategoryContentController@destroy');

        Route::post('update/award/categories/contents/{award_content_id}', 'AwardCategoryContentController@update');

        Route::post('/create/award/categories/contents', 'AwardCategoryContentController@store');

        Route::get('/award/admin/operation', 'AwardAdminOperationController@index');

        Route::post('/award/admin/operation/getuseraward', 'AwardAdminOperationController@show');

        Route::post('/award/admin/operation/getallstageaward', 'AwardAdminOperationController@getAllStageAward');

        Route::post('/award/admin/issue/user', 'AwardAdminOperationController@issueUserAward');

        Route::post('/create/unentered/award', 'AwardAdminOperationController@saveUserAwardLog');

//ban users route
        Route::get('/banneduserslist', 'AdminController@showBannedUsersPage');
        Route::get('/banuser', 'AdminController@showPageToBanUsers');

        Route::post('/banuser', 'AdminController@banUserAccount');
        Route::get('/blockdormant', 'AdminController@blockDormantAccounts');

//pin print request

        Route::get('/adminviewpinrequest', 'PingenerationController@ShowAllUserPinRequestToAdmin');
        Route::get('/showunprintedpinpage', 'PingenerationController@showUnprintedPinPage');
        Route::get('/adminsendpinrequest/{batch_id}', 'PingenerationController@sendUserPinToUser');
        Route::get('/showpinsgeneratedpage', 'PingenerationController@showPinsGeneratedPage');
        Route::get('/showgeneratepinpage', 'PingenerationController@showGeneratePinPage');
        Route::get('/printpinpage', 'PingenerationController@showPrintPinPage');
        Route::get('/showprintedpinspage', 'PingenerationController@showPrintedPinsPage');

        Route::get('/admin-operation/get-pin-reprint', 'AdminOperationController@getPINReprint');

        Route::get('/calculateusersbonusforid/{membershipid}', 'AdminController@calculateUsersBonusForId');
        Route::get('calculateusersdownline', 'AdminController@calculateUsersDownline');
        Route::get('/changeparent', 'AdminController@showchangeparent');
        Route::post('/changeparent', 'AdminController@changeparent');
        Route::get('/mlmsetting', 'AdminController@showlmssetting');
        Route::get('/truncatetables', 'AdminController@truncatetables');
        Route::get('/backuptables', 'AdminController@backuptables');
        //Route::get('/appsetting','UserController@appsetting');
        Route::get('showdeduct', array('as' => 'getautocomplete', 'uses' => 'AdminController@showdeduct'));
        //Route::post('processdeduct',array('as'=>'processdeduct','uses'=>'AdminController@processdeduct'));
        Route::post('processdeduct', array('as' => 'processdeduct', 'uses' => 'accountcontroller@deductfromuseraccount'));
        //generate pin route
        Route::post('/generatepin', array('as' => 'generatepin', 'uses' => 'AdminController@pingenerator'));
        Route::post('/printpins', array('as' => 'printpins', 'uses' => 'AdminController@printpin'));
        Route::get('/generatepin2', array('as' => 'generatepin2', 'uses' => 'AdminController@test'));
        Route::get('/accountdetails', array('as' => 'accountdetails', 'uses' => 'AdminController@accoutdetails'));

        //shop admin routes
        //categories
        Route::get('/adminshop', 'Adminshopcontroller@viewcategory');
        Route::get('/savecategories', 'Adminshopcontroller@showshop');
        Route::get('/updatecategory', 'Adminshopcontroller@showshop');
        Route::get('/deletecategory', 'Adminshopcontroller@showshop');
        Route::get('/showinsertcategory', 'Adminshopcontroller@viewinsertcategory');

        //By MeshManuel @ 28-10-2016
        Route::get('/category-edit/{catID}', 'Adminshopcontroller@getcategoryeditview')->where('catID', '[0-9]+');
        Route::post('/category-update', 'Adminshopcontroller@updatecategory');
        Route::get('/category-delete/{catID}', 'Adminshopcontroller@deletecategory')->where('catID', '[0-9]+');
        Route::post('/new-category', 'Adminshopcontroller@insertcategory');
        Route::get('/showinsertsubcategory/{catID}', 'Adminshopcontroller@viewinsertsubcategory')->where('catID', '[0-9]+');

        Route::get('/subcategory/{catID}/{id}', 'Adminshopcontroller@findsubcategories')->where('catID', '[0-9]+')->where('id', '[0-9]+');
        Route::get('/subcategories/{catID}', 'Adminshopcontroller@getsubcategoriesByCatID')->where('catID', '[0-9]+');
        Route::post('/new-subcategory', 'Adminshopcontroller@insertsubcategory');
        Route::get('/subcategory-delete/{subCatID}', 'Adminshopcontroller@deletesubcategory')->where('subCatID', '[0-9]+');
        Route::get('/edit-subcategory/{catID}/{subCatID}', 'Adminshopcontroller@getsubcategoryeditview')->where('catID', '[0-9]+')->where('subCatID', '[0-9]+');
        Route::post('/update-subcategory', 'Adminshopcontroller@updatesubcategory');

        Route::get('/showproduct', 'Adminshopcontroller@viewproduct');
        Route::get('/createproduct', 'Adminshopcontroller@createproduct');
        Route::post('/insertproduct', 'Adminshopcontroller@insertproduct');
        Route::post('/updateproduct', 'Adminshopcontroller@updateproduct');
        Route::get('/product/{id}', 'Adminshopcontroller@getaparticularproduct')->where('id', '[0-9]+');
        Route::get('/product-by-category/{catID}', 'Adminshopcontroller@getproductbysubcategoryid')->where('catID', '[0-9]+');
        Route::get('/product-delete/{productID}', 'Adminshopcontroller@deleteproduct')->where('productID', '[0-9]+');

        Route::get('/checkout', 'Shopcontroller@getCheckout');
        Route::get('/cart', 'Shopcontroller@getcart');

        //New Routes
        //New @ 6-Nov-2016 By MeshManuel

        Route::get('/showorders', 'OrdersController@getAllOrders');
        Route::get('/delete-order/{orderID}', 'OrdersController@deleteOrder')->where('orderID', '[0-9]+');
        Route::get('/order-status/{orderID}/{statusID}', 'OrdersController@setUpdateStatus')->where('orderID', '[0-9]+')->where('statusID', '[0-3]');

        //payout admin routes

        Route::get('/showpayouts', 'AdminController@showpayouts');

        Route::post('/setpayoutstatus', 'AdminController@setpayoutstatus');

        Route::get('/showpaidpayout', 'AdminController@showpaidpayout');
//gallery routes
        Route::get('/gallery/list', 'GalleryController@viewGalleryList');
        Route::post('/gallery/save', 'GalleryController@saveGallery');
        Route::get('/gallery/view/{id}', 'GalleryController@viewGalleyPics');
        Route::post('/gallery/do-upload', 'GalleryController@doImageUpload');
        Route::get('/gallery/delete/{id}', 'GalleryController@deleteGallery');
        Route::get('/gallery/delete-image/{id}', 'GalleryController@deleteimage');
        Route::get('/gallery/update-image/{id}', 'GalleryController@showupdate');
        Route::post('/gallery/update-image/{id}', 'GalleryController@updateimageithcaption');

//blog routes
        Route::get('/blog/newcategory', 'blogController@viewCategory');
        Route::post('/blog/savenewcategory', 'blogController@createCategory');
        Route::get('/blog/showcategories', 'blogController@viewAllCategories');
        Route::get('/blog/showupdate/{id}', 'blogController@showUpdatePage');
        Route::get('/blog/update', 'blogController@updateCategory');
        Route::get('/blog/delete/{id}', 'blogController@deleteGallery');
        Route::get('/reports', function () {
            return view('report.index');
        });
        Route::get('/fetch-result', 'ReportController@getInfoByID');

//Notification Routes
        Route::get('/notification', 'NotificationController@getAllNotifications');
        Route::post('/store-notification', 'NotificationController@store');
        Route::get('/edit-notification/{id}', 'NotificationController@find');
        Route::get('/delete-notification/{id}', 'NotificationController@delete');
        Route::post('/update-notification', 'NotificationController@update');
        Route::get('/create-notification', function () {
            return view('notification.create');
        });

        // ---------------------------------------------------------------------
        // GENERATE STAGE 3 PIN
        // ---------------------------------------------------------------------
        Route::get('/stage-three-pin', 'AdminOperationController@getStageThreePinIndex');
        Route::post('/generate-stage-three-pins', 'StageThreePinController@generateStageThreePins');

    });

//My Orders
    Route::get('/my-orders', 'OrdersController@allByID');
    Route::get('/edit-order/{id}', 'OrdersController@findUserOrder')->where('id', '[0-9]+');
    Route::get('/cancel-order/{id}', 'OrdersController@cancelOrder')->where('id', '[0-9]+');;
    Route::post('/update-order', 'OrdersController@updateOrder');
    Route::get('/generate-invoice/{id}', 'OrdersController@generateInvoice')->where('id', '[0-9]+');;
    Route::get('/complete-order/{id}', 'OrdersController@completeOrder')->where('id', '[0-9]+');;
    Route::get('/order-transfer', function () {
        return view('orders.transfer-order');
    });
    Route::post('/transfer-order', 'OrdersController@transferOrder');

    //payout routes
    Route::get('/paidpayout', 'UserController@showpaidpayoutforusers');
    Route::get('/pendingpayout', 'UserController@showpendingpayoutforusers');

//mlm routes
    Route::get('/showdownlines', 'UserController@showdownlines');

    Route::get('/printtree', 'UserController@maketree3');
    Route::get('/printdown', 'UserController@showdownline');
    Route::get('/getchildren', 'UserController@showchildren');

    //userprofile
    Route::get('/viewprofile', 'UserController@showprofile');
    //Route::get('/viewprofile','UserController@editprofile');
    Route::get('/editpersonalinfo', 'UserController@showeditpersonalinfo');
    Route::post('/editpersonalinfo', 'UserController@editpersonalinfo');
    //Route::post('/editpersonalinfo',function(){
    // return "contact Head Ofiice for Profile Editing";
    //});
    Route::get('/editbankinfo', 'UserController@showeditbankinfo');
    Route::post('/editbankinfo', 'UserController@editbankinfo');
    Route::get('/changepassword', 'UserController@showeditpasswordinfo');
    Route::post('/changepassword', 'UserController@editpasswordinfo');
    Route::get('/changewalletpassword', 'UserController@showeditWalletinfo');
    Route::post('/changewalletpassword', 'UserController@editWalletpasswordinfo');
    Route::post('/uploadprofilepic', 'UserController@updateprofile');
    //user members tree
    //showmembertreepage
    Route::get('/showmemberstree', 'UserController@showmembertreepage');

    Route::get('/showmemberstable', 'UserController@showmemberstablepage');
    Route::get('/showmemberstablegraph/{take}/{limit}', 'UserController@showmemberstablepagegraph');

    Route::get('/members-chart-init', array('as' => 'members-chart-init', 'uses' => 'UserController@sendusermemberstreeinitialdata'));
    Route::get('/members-chart-init2/{membershipid}', array('as' => 'members-chart-init2', 'uses' => 'UserController@searchifuserisdownline'));
    Route::get('/members-chart-children/{membershipid}', array('as' => 'members-chart-children', 'uses' => 'UserController@sendchildrenchildrendata'));

//calculate and get downlines ajax route
    Route::post('/calculatedownlines', array('as' => 'calculatedownlines', 'uses' => 'UserController@countUserDownlineswithAjax'));

//calculate and get bonus ajax route
    Route::post('/calculatebonus', array('as' => 'calculatebonus', 'uses' => 'UserController@CalculateUserBonusWithAjax'));

    Route::post('/acceptTerms', array('as' => 'acceptTerms', 'uses' => 'UserController@setAcceptTerms'));

//mlm registrtion routes

    //test of getting freenode

    Route::get('/getfreespace', 'websitecontroller@getfreepositiondisplay');

    Route::post('/saveregister', 'RegistrationController@submitreg');
    Route::post('/register', 'RegistrationController@submitreg');
    Route::post('/registerfirstuser', 'RegistrationController@registerfirstuser');
    Route::post('/registeradmin', 'RegistrationController@registeradmin');
    Route::post('availableusername', array('as' => 'availableusername', 'uses' => 'websitecontroller@returnavailableusername'));
    Route::post('showmembershipid', array('as' => 'showmembershipid', 'uses' => 'websitecontroller@returnmembershipid'));
    Route::get('/join-now/{membershipid}', 'RegistrationController@registerbyreferall');
    Route::get('/addaccount', 'UserController@showaddaccount');
    Route::post('/addregistration', 'RegistrationController@addaccountregister');

    Route::get('getautocompletemembershipid', array('as' => 'getautocompletemembershipid', 'uses' => 'AdminController@getautocompletemembershipid'));
//

//Route::get('store/view/{sales_id}','store@viewsale');

//chart routes

    Route::get('/chartdata', 'Mlmcontroller@chartcomplete');

    Route::get('/getlastid', 'PingenerationController@getthememberid');
//shopping cart routes

    Route::get('/shop', 'Shopcontroller@showshop');

// I DISABLED THE SHOP BECAUSE OF SQL INJECTION ERRORS
    //   Route::post('/add-to-whishlist/{id}',array('as'=>'addtowhishlist','uses'=>'Shopcontroller@addtowhishlist'));
    //   Route::post('/add-to-cart/{id}', array('as'=>'addtocart','uses'=>'Shopcontroller@getaddtocart'));

//   Route::get('/details/{productName}',array('as'=>'details','uses'=>'Shopcontroller@viewproductdetail'))->where('productName', '[-a-z]+');

//   Route::get('/sub/{subcategory}',array('as'=>'details','uses'=>'Shopcontroller@viewshopbasedonsubcategory'))->where('subcategory', '[-a-z]+');
    //   Route::post('/update-cart/{id}',array('as'=>'updatecart','uses'=>'Shopcontroller@updateproductincart'));
    //   Route::post('/delete-from-cart/{id}',array('as'=>'delete-from-cart','uses'=>'Shopcontroller@removefromcart'));

//   Route::get('/cart','Shopcontroller@getcart');
    //   Route::get('/wishlist','Shopcontroller@viewwishlist');

//   Route::post('/remove-from-wishlist/{id}', array('as'=>'removefromwishlist','uses'=>'Shopcontroller@removefromwishlist'));
    //   Route::post('/check-balance', array('as'=>'checkbalance','uses'=>'OrdersController@checkbalance'));
    //   Route::post('/store-orders', 'OrdersController@newOrder');

// //shopping cart admin routes

//   Route::get('/checkout', 'Shopcontroller@getCheckout');
    //   Route::get('/cart','Shopcontroller@getcart');

//   //product

//   //Orders
    //  // Route::get('/showorders','Adminshopcontroller@viewproduct');
    //   //Route::post('/updateorders','Adminshopcontroller@viewproduct');
    //   //Route::get('/showproduct','Adminshopcontroller@viewproduct');
    //   //Route::get('/showproduct','Adminshopcontroller@viewproduct');
    //    //My Orders
    //   Route::get('/my-orders', 'OrdersController@allByID');
    //   Route::get('/edit-order/{id}', 'OrdersController@findUserOrder');
    //   Route::get('/cancel-order/{id}', 'OrdersController@cancelOrder');
    //   Route::post('/update-order', 'OrdersController@updateOrder');
    //   Route::get('/generate-invoice/{id}', 'OrdersController@generateInvoice');
    //   Route::get('/complete-order/{id}', 'OrdersController@completeOrder');
    //   Route::get('/order-transfer/{id}', 'OrdersController@displayTransferOrderView');
    //   Route::post('/transfer-order', 'OrdersController@transferOrder');
    //   Route::get('/orders', function() {
    //       return view('orders.search');
    //   });
    //   Route::get('/get-orders', 'OrdersController@getOrderList');

    //script to calculate completebonus
    Route::get('/calculatecompletionbonus', 'accountcontroller@scripttoaddtotheusers');
    Route::get('/calculatecurrentamount', 'accountcontroller@getallmembers');
    Route::get('/paycomissiontotable', 'accountcontroller@paycomissiontotable');

    //Sub account and their records routes
    Route::get('/showsubaccounts', 'UserController@getsubaccounts');
    Route::get('/subaccount/{membershipid}', 'SubaccountController@showsubaccountdownlines');
    Route::get('/transfertomain/{membershipid}', 'SubaccountController@showsubaccountcashtransfer');
    Route::post('/transfertomain', 'SubaccountController@transfertomainaccount');
//Route::get('/showsubaccounts','Mlmcontroller@getsubaccounts');

    Route::group(['middleware' => ['notification']], function () {


        Route::get('', function () {
            return view('website.pages.index');
        })->name('pages.index');

        Route::get('/about-us', function () {
            return view('website.pages.about');
        })->name('pages.about');

        Route::get('/faq', function () {
            return view('website.pages.faq');
        })->name('pages.faq');

        Route::get('/contact', function () {
            return view('website.pages.contactus');
        });

        Route::get('/compensation-plan', function () {
            return view('website.pages.compensation-plan');
        });

        Route::get('/join-now', function () {
            $headers = array('Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT');
            return view('website.join-now4', $headers);
        });

        Route::get('/login', function () {
            return view('website.login');
        });

        Route::post('/online-pin-generator', function () {
            $data = 'List of generated pins';
              
            return response()->json($data);
        });
    });
    Route::get('/showlist', 'DuplicationDetector@showList');
    Route::get('/removeduplicates', 'DuplicationDetector@getandDeleteDuplicate');

//food collection
    Route::get('/food-collection', 'FoodCollectionController@index');
    Route::get('/food-collection/products', array('as' => 'getProducts', 'uses' => 'FoodCollectionController@getProducts'));
    Route::post('/food-collection/submit', 'FoodCollectionController@submitRequest');
    Route::get('/food-collection/get_food_history', 'FoodCollectionController@getHistory');
    Route::get('/food-collection/food_history', function () {
        return view('foodcollection.log');
    });
    Route::get('/food-collection/leaders-reports', function () {
        return view('foodcollection.leaders-report');
    });
    Route::get('/food-collection/leaders-reports/generate', 'FoodCollectionController@reportGeneratorForLeaders');

    Route::get('/food-collection/accountfoodreport', 'FoodCollectionController@showAccountFoodReportPage');

    Route::post('/food-collection/getaccountfoodreport/generate', array('as' => 'getaccountfoodreport', 'uses' => 'FoodCollectionController@getAccountFoodReport'));

    Route::get('/food-collection/useraccountidandsubaccountid', array('as' => 'useraccountidandsubaccountid', 'uses' => 'FoodCollectionController@returnJsonForUserMembershipIdAndSubAccountDetails'));

    //new subaccount function routes
    Route::get('/subaccountdownlinestable/{subaccountmembershipid}', 'SubaccountController@showSubAccountDownlinesInTable');
    //test free position with space
    Route::get('/testgetfreepositionwithspace', 'websitecontroller@testGetFreePositionWithSpace');

    Route::get('/accounts-referred', 'UserController@showreferred');

    Route::get('/fixmultiplelegserror/{limit}', 'FixMultipleLegErrorController@getAndCorrectAllDuplicatedLegs');

    Route::get('/testinggetfreespace', 'websitecontroller@testinggetfreespace');

    Route::get('/testregistration', 'RegistrationController@testRegistration');

    Route::get('/cronforrightstage', 'UserController@setusersstagetotherightone');

    Route::get('/cronforcreatingmatrixusers', 'UserController@runCreateMatrixUsers');

    Route::get('/cronfordeletingmatrixusers', 'UserController@deleteCreateMatrixUsers');

    Route::get('/creatematrixforauser/{membershipid}', 'UserController@createMatrixForaUser');

    Route::get('/createStageOneMatrixForUser/{membershipid}', 'UserController@createStageOneMatrixForUser');

    Route::get('/fixuseraccountbalance', 'IncorrectBalanceFixer@index');

    Route::get('/mainaccountsubaccount', 'MainAccountSubAccount@index');

    Route::get('/checkalluseraccountbalance', 'CheckAllUserBalance@index');
    Route::get('/fixexcessfood', 'FixExcessFoodOrderController@index');
    Route::get('/fixexcessfood_new/{start}/{end}', 'FixExcessFoodOrderController@getDuplicate');
    Route::get('/fixexcessfoodbygroup/{group_leader_id}', 'FixExcessFoodOrderController@bygroupid');
    Route::get('/fixexcessfoodbyid/{membershipid}', 'FixExcessFoodOrderController@fixUserAccount');

    include ('apiroutes.php');

    //extra referral removal
    Route::get('/removeextrareferral', 'DuplicationDetector@removeExtraReferralMoney');
    Route::get('/calculatebonusforgroup', 'DuplicationDetector@calculateMoneyInGroup');

    Route::get('/downloadform', 'UserController@downloadForm');

    Route::get('/calculatedownlinesforgroup/{group_leader_id}', 'UserController@calculateDownlinesCron');

    //user award routes

    Route::get('/awards', 'AwardUserController@index');

    Route::get('/viewawardproduct/{id}', 'AwardUserController@show');

    Route::get('/requestawardproduct/{id}/{membershipid}', 'AwardUserController@requestawardformainaccount');

    Route::get('/calculatefoodaward', 'SustainabilityController@fillAllStageTwoLog');

    Route::get('/calculateandreturncash', 'accountcontroller@returnMoneyWithPercentgeCut');

    Route::get('/fixissues/{id}', 'AdminOperationController@fixIssues');

    Route::get('/showstagefourmemberstable/{membershipid}', 'UserController@getmembersfornewstagefour');

    Route::get('/test_exec', 'AdminOperationController@testExec');

});
