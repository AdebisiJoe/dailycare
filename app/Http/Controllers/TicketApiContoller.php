<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

use App\Comment;
use App\User;
use Auth;





use App\category2;
use App\Mailers\AppMailer;
use App\Ticket;
use App\Http\Controllers\TicketsController;

class TicketApiContoller extends Controller
{
    function __construct()
    {
        $this->middleware('jwt.auth');
    }


    public function createTicket(Request $request){

        try{

            $this->validate($request, [
                'title'     => 'required',
                'category'  => 'required',
                'priority'  => 'required',
                'message'   => 'required',
                'membershipid'=>'required'
            ]);

            $post = $request->all();
            $title = $post['title'];
            $category = $post['category'];
            $priority = $post['priority'];
            $message = $post['message'];
            $membershipid = $post['membershipid'];

            $result=DB::table('member_table')->select('username')->where('membershipid','=',$membershipid)->first();



            $username=$result->username;

            $result=DB::table('users')->select('id')->where('username','=',$username)->first();

            $user_id =$result->id;


            $ticket = new Ticket([
                'title'     => $post['title'],
                'user_id'   => $user_id,
                'ticket_id' => strtoupper(str_random(10)),
                'category_id'  => $post['category'],
                'priority'  => $post['priority'],
                'message'   => $post['message'],
                'status'    => "Open",
            ]);

            $ticket->save();


            return json_encode(['data'=>'done']);

        }catch (\Exception $e)
        {
            return response('error',400);
        }



    }

    public function userTicketList(Request $request){
        try{

            $post = $request->all();

            $membershipid = $post['membershipid'];

            $result=DB::table('member_table')->select('username')->where('membershipid','=',$membershipid)->first();

            $username=$result->username;

            $result=DB::table('users')->select('id')->where('username','=',$username)->first();

            $user_id =$result->id;

            //$tickets = Ticket::join('categories', 'category_id', '=', 'id')->where('user_id', $user_id)->paginate(10);


            $tickets = DB::table('tickets as t')->join('categories as c', 't.category_id','=', 'c.id')->where('user_id', $user_id)->get();

            //$categories = category2::all();



            return json_encode(['tickets'=>$tickets]);

        }catch (\Exception $e)
        {
            return response('error',400);
        }


    }

    public function viewTicketComments(Request $request){

        try{
            $post=$request->all();
            $ticket_id=$post['ticket_id'];

            $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

            $comments = $ticket->comments;

            $category = $ticket->category;

            $ticketId=$ticket->id;
            $ticketOwnerId=$ticket->user_id;

            $ticketController=new TicketsController();

            //$this->setCommentToSeen($ticketId,$ticketOwnerId);

            $membershipid=$ticketController->getUserMembershipId($ticketOwnerId);

            return json_encode(['ticket'=>$ticket,'category'=>$category,'comments'=>$comments,'membershipid'=>$membershipid]);

            // return json_encode(['ticket'=>$ticket,'category'=>$category,'comments'=>$comments]);

        }
        catch (\Exception $e)
        {
            return response('error',400);
        }



    }

    public function setCommentToSeen($ticketId,$ticketOwnerId)
    {

        if(Auth::User()->id==$ticketOwnerId){
            Comment::where('ticket_id',$ticketId)->update(['viewed_by_owner'=>1]);
        }
    }

    public function postComment(Request $request)
    {
        // try{
            $this->validate($request, [
                'comment'   => 'required',
                'ticket_id'   => 'required',
                'user_id'   => 'required'
            ]);
            $post = $request->all();
            $comment = $post['comment'];
            $ticket_id = $post['ticket_id'];
            $user_id = $post['user_id'];


            $comment = Comment::create([
                'ticket_id' => $ticket_id,
                'user_id'   => $user_id,
                'comment'   => $comment,
                'viewed_by_owner'=>0,
            ]);

            return json_encode(['data'=>'done']);

        // }catch (\Exception $e)
        // {
        //     return response('error',400);
        // }
    }
}
