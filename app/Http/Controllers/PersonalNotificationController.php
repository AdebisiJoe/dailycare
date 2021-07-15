<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PersonalNotification;

class PersonalNotificationController extends Controller
{
    //

    public function __construct()
    {

    }

    public function sendNotification($sender_id,$receiver_id,$message,$link)
    {
        //INSERT INTO `personalnotification`(`id`, `sender_id`, `user_id`, `message`, `link`, `viewed`, `created_at`, `updated_at`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
        $personalnotification=new PersonalNotification();
        $personalnotification->sender_id=$sender_id;
        $personalnotification->user_id=$receiver_id;
        $personalnotification->message=$message;
        $personalnotification->link=$link;
        $personalnotification->viewed=0;
        $personalnotification->save();

    }
    public function setMessageToViewed($receiver_id)
    {
        DB::table('personalnotification')
            ->where('$receiver_id',$receiver_id)
            ->update(['viewed' =>1]);
    }

    public function returnAllUserNoficationsNotViewed($user_id)
    {
        $personalnotifications=PersonalNotification::where('user_id',$user_id)->where('viewed',0)->get();

        return $personalnotifications;
    }

}
