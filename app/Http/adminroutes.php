<?php

Route::group(['middleware' => ['adminlock']], function () {

    // Route::get('/home',[
    //     'uses'=>'userController@showUserDashboard',
    //     'as'=>'home2',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ]);

    

    //dbfunctions
    // Route::get('/updatememberstable',[
    //     'uses'=>'DbFunctionsController@UpdateMemberTableWithNewValues',
    //     'as'=>'updatememberstable',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ]);

    //ban users route
   // Route::get('/banneduserslist', '');
    // Route::get('/banneduserslist',[
    //     'uses'=>'AdminController@showBannedUsersPage',
    //     'as'=>'banneduserslist',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ]);
    Route::get('/banuser', 'AdminController@showPageToBanUsers');
    // Route::get('/banuser',[
    //     'uses'=>'AdminController@showPageToBanUsers',
    //     'as'=>'banuser',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ]);

    Route::post('/banuser', 'AdminController@banUserAccount');
    // Route::post('/banuser',[
    //     'uses'=>'AdminController@banUserAccount',
    //     'as'=>'banuser',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ]);

//pin print request

    Route::get('/adminviewpinrequest', 'PingenerationController@ShowAllUserPinRequestToAdmin');
    // Route::get('/adminviewpinrequest',[
    //     'uses'=>'PingenerationController@ShowAllUserPinRequestToAdmin',
    //     'as'=>'adminviewpinrequest',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ])
    Route::get('/adminsendpinrequest/{batch_id}', 'PingenerationController@sendUserPinToUser');
    // Route::get('/adminsendpinrequest/{batch_id}',[
    //     'uses'=>'PingenerationController@sendUserPinToUser',
    //     'as'=>'/adminsendpinrequest/{batch_id}',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ])
    Route::get('/showpinsgeneratedpage', 'PingenerationController@showPinsGeneratedPage');
    
    Route::get('/showunprintedpinpage', 'PingenerationController@showUnprintedPinPage');
    // Route::get('/showpinsgeneratedpage',[
    //     'uses'=>'PingenerationController@showPinsGeneratedPage',
    //     'as'=>'/showpinsgeneratedpage',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ])
    Route::get('/showgeneratepinpage', 'PingenerationController@showGeneratePinPage');
    // Route::get('/showgeneratepinpage',[
    //     'uses'=>'PingenerationController@showGeneratePinPage',
    //     'as'=>'/showgeneratepinpage',
    //     'middleware'=>'roles',
    //     'roles'=>[admin']
    // ])
    Route::get('/printpinpage', 'PingenerationController@showPrintPinPage');
    // Route::get('/printpinpage',[
    //     'uses'=>'PingenerationController@showPrintPinPage',
    //     'as'=>'/printpinpage',
    //     'middleware'=>'roles',
    //     'roles'=>['admin']
    // ])
    Route::get('/showprintedpinspage', 'PingenerationController@showPrintedPinsPage');




//detectincompletematrixroutes
    Route::get('/incompletematrix', 'DetectIncompleteMatrix@showIncompleteMatrixPage');
    Route::post('incompletematrix2',array('as'=>'incompletematrix','uses'=>'DetectIncompleteMatrix@detectincompletematrix'));


    Route::get('/admin-operation/get-pin-reprint', 'AdminOperationController@getPINReprint');




    //Route::post('/calculateasigleuserbonus/{membershipid}', 'AdminController@findUserOrder');
    Route::get('calculateusersdownline','AdminController@calculateUsersDownline');

    Route::get('/calculateusersbonusforid/{membershipid}', 'AdminController@calculateUsersBonusForId');
    Route::get('/cutmembersubtree/{membershipid}', 'AdminController@cutMemberSubTree');
    Route::get('/calculateusersbonus', 'AdminController@calculateUsersBonus');
    Route::get('/changeparent','AdminController@showchangeparent');
    Route::post('/changeparent','AdminController@changeparent');
    Route::get('/mlmsetting','AdminController@showlmssetting');
    Route::get('/truncatetables','AdminController@truncatetables');
    Route::get('/backuptables','AdminController@backuptables');
    Route::get('/appsetting','UserController@appsetting');
    Route::get('showdeduct',array('as'=>'getautocomplete','uses'=>'AdminController@showdeduct'));
    //Route::post('processdeduct',array('as'=>'processdeduct','uses'=>'AdminController@processdeduct'));
    Route::post('processdeduct',array('as'=>'processdeduct','uses'=>'accountcontroller@deductfromuseraccount'));
    //generate pin route
    Route::post('/generatepin',array('as'=>'generatepin','uses'=>'AdminController@pingenerator'));
    Route::post('/printpins',array('as'=>'printpins','uses'=>'AdminController@printpin'));
    Route::post('/reprintpins',array('as'=>'printpins','uses'=>'AdminController@reprintpin'));
    Route::get('/generatepin2',array('as'=>'generatepin2','uses'=>'AdminController@test'));



    
    Route::get('/accountdetails',array('as'=>'accountdetails','uses'=>'AdminController@accoutdetails'));

    //shop admin routes
    //categories
    Route::get('/adminshop','Adminshopcontroller@viewcategory');
    Route::get('/savecategories','Adminshopcontroller@showshop');
    Route::get('/updatecategory','Adminshopcontroller@showshop');
    Route::get('/deletecategory','Adminshopcontroller@showshop');
    Route::get('/showinsertcategory','Adminshopcontroller@viewinsertcategory');

    //By MeshManuel @ 28-10-2016
    Route::get('/category-edit/{catID}','Adminshopcontroller@getcategoryeditview')->where('catID', '[0-9]+');
    Route::post('/category-update','Adminshopcontroller@updatecategory');
    Route::get('/category-delete/{catID}','Adminshopcontroller@deletecategory')->where('catID', '[0-9]+');
    Route::post('/new-category','Adminshopcontroller@insertcategory');
    Route::get('/showinsertsubcategory/{catID}','Adminshopcontroller@viewinsertsubcategory')->where('catID', '[0-9]+');

    Route::get('/subcategory/{catID}/{id}','Adminshopcontroller@findsubcategories')->where('catID', '[0-9]+')->where('id', '[0-9]+');
    Route::get('/subcategories/{catID}','Adminshopcontroller@getsubcategoriesByCatID')->where('catID', '[0-9]+');
    Route::post('/new-subcategory', 'Adminshopcontroller@insertsubcategory');
    Route::get('/subcategory-delete/{subCatID}','Adminshopcontroller@deletesubcategory')->where('subCatID', '[0-9]+');
    Route::get('/edit-subcategory/{catID}/{subCatID}','Adminshopcontroller@getsubcategoryeditview')->where('catID', '[0-9]+')->where('subCatID', '[0-9]+');
    Route::post('/update-subcategory','Adminshopcontroller@updatesubcategory');

    Route::get('/showproduct','Adminshopcontroller@viewproduct');
    Route::get('/createproduct', 'Adminshopcontroller@createproduct');
    Route::post('/insertproduct', 'Adminshopcontroller@insertproduct');
    Route::post('/updateproduct','Adminshopcontroller@updateproduct');
    Route::get('/product/{id}','Adminshopcontroller@getaparticularproduct')->where('id', '[0-9]+');
    Route::get('/product-by-category/{catID}','Adminshopcontroller@getproductbysubcategoryid')->where('catID', '[0-9]+');
    Route::get('/product-delete/{productID}','Adminshopcontroller@deleteproduct')->where('productID', '[0-9]+');

    Route::get('/checkout', 'Shopcontroller@getCheckout');
    Route::get('/cart','Shopcontroller@getcart');


    //New Routes
    //New @ 6-Nov-2016 By MeshManuel

    Route::get('/showorders','OrdersController@getAllOrders');
    Route::get('/delete-order/{orderID}','OrdersController@deleteOrder')->where('orderID', '[0-9]+');
    Route::get('/order-status/{orderID}/{statusID}','OrdersController@setUpdateStatus')->where('orderID', '[0-9]+')->where('statusID', '[0-3]');




    //payout admin routes

    Route::get('/showpayouts','AdminController@showpayouts');

    Route::post('/setpayoutstatus','AdminController@setpayoutstatus');

    Route::get('/showpaidpayout','AdminController@showpaidpayout');
//gallery routes
    Route::get('/gallery/list','GalleryController@viewGalleryList');
    Route::post('/gallery/save','GalleryController@saveGallery');
    Route::get('/gallery/view/{id}','GalleryController@viewGalleyPics');
    Route::post('/gallery/do-upload','GalleryController@doImageUpload');
    Route::get('/gallery/delete/{id}','GalleryController@deleteGallery');
    Route::get('/gallery/delete-image/{id}','GalleryController@deleteimage');
    Route::get('/gallery/update-image/{id}','GalleryController@showupdate');
    Route::post('/gallery/update-image/{id}','GalleryController@updateimageithcaption');



//blog routes
    Route::get('/blog/newcategory','blogController@viewCategory');
    Route::post('/blog/savenewcategory','blogController@createCategory');
    Route::get('/blog/showcategories','blogController@viewAllCategories');
    Route::get('/blog/showupdate/{id}','blogController@showUpdatePage');
    Route::get('/blog/update','blogController@updateCategory');
    Route::get('/blog/delete/{id}','blogController@deleteGallery');
    Route::get('/reports', function(){
        return view('report.index');
    });
    Route::get('/fetch-result', 'ReportController@getInfoByID');

//Notification Routes
    Route::get('/notification', 'NotificationController@getAllNotifications');
    Route::post('/store-notification', 'NotificationController@store');
    Route::get('/edit-notification/{id}', 'NotificationController@find');
    Route::get('/delete-notification/{id}', 'NotificationController@delete');
    Route::post('/update-notification', 'NotificationController@update');
    Route::get('/create-notification',function(){
        return view('notification.create');
    });


    //admin for award system
    Route::get('/create/award/categories', 'AwardCategoryController@create' );

    Route::get('/view/award/categories','AwardCategoryController@show');

    Route::get('/edit/award/categories/{award_id}', 'AwardCategoryController@edit' );

    Route::get('/delete/award/categories/{award_id}', 'AwardCategoryController@destroy' );

    Route::post('create/award/categories', 'AwardCategoryController@store' );

    Route::post('update/award/categories/{award_id}', 'AwardCategoryController@update' );

    Route::get('/create/award/categories/contents', 'AwardCategoryContentController@create' );

    Route::get('/view/award/categories/contents', 'AwardCategoryContentController@show' );

    Route::get('/edit/award/categories/contents/{award_content_id}', 'AwardCategoryContentController@edit' );

    Route::get('/delete/award/categories/contents/{award_content_id}', 'AwardCategoryContentController@destroy' );

    Route::post('update/award/categories/contents/{award_content_id}', 'AwardCategoryContentController@update' );

    Route::post('/create/award/categories/contents', 'AwardCategoryContentController@store' );

    Route::get('/award/admin/operation', 'AwardAdminOperationController@index');

    Route::post('/award/admin/operation/getuseraward', 'AwardAdminOperationController@show');

    Route::post('/award/admin/operation/getallstageaward', 'AwardAdminOperationController@getAllStageAward');

    Route::post('/award/admin/issue/user', 'AwardAdminOperationController@issueUserAward');

    Route::post('/create/unentered/award', 'AwardAdminOperationController@saveUserAwardLog');

    Route::get('/getallstagesaccountdetails', 'AdminController@getStageAccountBalance');


});
