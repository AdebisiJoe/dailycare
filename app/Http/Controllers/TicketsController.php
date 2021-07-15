<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

use App\category2;
use App\Mailers\AppMailer;
use App\Ticket;

class TicketsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    

        public function index()
        {
            $tickets = Ticket::paginate(10);
            $categories = category2::all();

            return view('tickets.index', compact('tickets', 'categories'));
        }



        public function create()
        {
            $categories = category2::all();

            return view('tickets.create', compact('categories'));
        }


        public function store(Request $request, AppMailer $mailer)
        {
            $this->validate($request, [
                    'title'     => 'required',
                    'category'  => 'required',
                    'priority'  => 'required',
                    'message'   => 'required'
                ]);

                $ticket = new Ticket([
                    'title'     => $request->input('title'),
                    'user_id'   => Auth::user()->id,
                    'ticket_id' => strtoupper(str_random(10)),
                    'category_id'  => $request->input('category'),
                    'priority'  => $request->input('priority'),
                    'message'   => $request->input('message'),
                    'status'    => "Open",
                ]);

                $ticket->save();

               // $mailer->sendTicketInformation(Auth::user(), $ticket);

                return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
        }

        // delivery into the followin code will profer

        public function userTickets()
        {
            $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
            $categories = category2::all();

            return view('tickets.user_tickets', compact('tickets', 'categories'));
        }

        public function userTicketsSearch(Request $req)
        {

            $tickets = Ticket::where('ticket_id', $req->TicketId)->paginate(10);
            $categories = category2::all();

            return view('tickets.index', compact('tickets', 'categories'));
        }

       


        // public function show($ticket_id)
        // {
        //     $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        //     $category = $ticket->category;

        //     return view('tickets.show', compact('ticket', 'category'));
        // }

        public function show($ticket_id)
        {
            $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

            $comments = $ticket->comments;

            $category = $ticket->category;

            $ticketId=$ticket->id;
            $ticketOwnerId=$ticket->user_id;

            $this->setCommentToSeen($ticketId,$ticketOwnerId);

            $membershipid=$this->getUserMembershipId($ticketOwnerId);

            return view('tickets.show', compact('ticket', 'category', 'comments','membershipid'));
        }
         

         public function getUserMembershipId($ticketOwnerId)
        {
            $result=DB::table('users')->where('id','=',$ticketOwnerId)->select('username')->first();

            $value=DB::table('member_table')->where('username','=',$result->username)->select('membershipid')->first();

           return  $membershipid=$value->membershipid;
        }


      


        public function close($ticket_id, AppMailer $mailer)
        {
            $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

            $ticket->status = 'Closed';

            $ticket->save();

            $ticketOwner = $ticket->user;

           // $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

            return redirect()->back()->with("status", "The ticket has been closed.");
        }


        public function re_open($ticket_id, AppMailer $mailer)
        {
            $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

            $ticket->status = 'Open';

            $ticket->save();

            $ticketOwner = $ticket->user;

           // $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

            return redirect()->back()->with("status", "The ticket has been Re-opened.");
        }

        public function countUserMessages()
        {
            $userId=Auth::User()->id;
  
            $userMessagesCount= DB::table('comments as c')
                ->join('tickets as t', 'c.ticket_id', '=', 't.id')
                ->where('t.user_id', '=',$userId)
                ->where('c.user_id', '!=',$userId)
                ->where('viewed_by_owner',0)
                ->count();

            return $userMessagesCount;
        }
        public function returnUserMessages()
        {
            $userId=Auth::User()->id;
            $userMessages= DB::table('comments as c')
                ->join('tickets as t', 'c.ticket_id', '=', 't.id')
                ->where('t.user_id', '=',$userId)
                ->where('c.user_id', '!=',$userId)
                ->where('viewed_by_owner',0)
                ->get();
            return $userMessages;
        }
        public function setCommentToSeen($ticketId,$ticketOwnerId)
        {

            if(Auth::User()->id==$ticketOwnerId){
            Comment::where('ticket_id',$ticketId)->update(['viewed_by_owner'=>1]);
            }
        }
}
