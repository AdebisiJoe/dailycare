<?php

Route::get('getuserprofileinformation', 'ProfileApiController@getUserProfileInformation');
Route::post('userprofileinformation/store', 'ProfileApiController@storeUserProfileInformation');
Route::post('userpassword/store', 'ProfileApiController@storeNewPasswordInformation');
Route::post('userbankinformation/store', 'ProfileApiController@storeNewBankInformation');