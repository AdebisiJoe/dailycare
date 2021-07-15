<?php

Route::get('getgroups','FoodCollectionApiController@getGroups');
Route::get('getproducts','FoodCollectionApiController@getProducts');
Route::post('getuseraccountbalance','FoodCollectionApiController@getUserAccountBalance');
Route::post('getsubaccountinformation','FoodCollectionApiController@getSubAccountInformation');
Route::post('submitfoodrequestform','FoodCollectionApiController@submitFoodRequestForm');
Route::post('getfoodcollectedhistory','FoodCollectionApiController@getFoodCollectedHistory');
Route::get('getreports','FoodCollectionApiController@getReports');
Route::post('gettotalorders','FoodCollectionApiController@getTotalOrders');
