<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
          'showaccount','registerfirstuser','registeradmin','generatepin','addregistration','editprofile', 'processdeduct','insertproduct','saveproduct','updateproduct','deleteproduct','update-subcategory','new-subcategory','new-category','category-update','transfertomain','transfercash','payoutcash','store-orders','gallery/save','gallery/do-upload','changepassword','editpersonalinfo','editbankinfo','getavailableamount','setnewamount','gallery/update-image/*','update-notification','store-notification','update-order','transfer-order','changeparent','members-chart-init/*','adminchangepassword','transferpayoutcashfromfoodcash','subaccounttranfertofoodcash','removestagetwoduplicate','food-collection/submit','showchangetransactionpassword','banuser','api/*','saveregister','changewalletpassword'
    ];
}
