@if (Auth::user()->role=='admin')
<li class="header">MENU</li>
<li class="">
    <a href="{{url('/home')}}">
        <i class="fa fa-th"></i> <span>Dashboard</span> 
    </a>
</li>
<li class="">
    <a href="{{url('/admin-operation')}}"><i class="fa fa-gear"></i>Operations</a>

</li> 
 


<li class="">
    <a href="{{url('/showchangetransactionpassword')}}"><i class="fa fa-users"></i>Change Transactions Password</a>

</li>

<li class="">
    <a href="{{url('/changeuserpassword')}}"><i class="fa fa-users"></i>Change User Password</a>

</li>




<li class="treeview">
    <a href="#">
        <i class="fa fa-ticket"></i>
        <span>Pin Functions</span>
        <!-- <span class="label label-success">New</span> -->
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/showgeneratepinpage')}}"><i class="fa fa-circle-o"></i>Generate Pin</a></li>
        <li><a href="{{url('/showpinsgeneratedpage')}}"><i class="fa fa-circle-o"></i>View Pins Generated</a></li>
         <li><a href="{{url('/showunprintedpinpage')}}"><i class="fa fa-circle-o"></i>unprinted pins</a></li>
        <li><a href="{{url('/showprintedpinspage')}}"><i class="fa fa-circle-o"></i>View Printed Pins Page</a></li>
        <li><a href="{{url('/adminviewpinrequest')}}"><i class="fa fa-circle-o"></i>View Pins Request</a></li>
        <li><a href="{{url('/printpinpage')}}"><i class="fa fa-circle-o"></i>Print Pin Page</a></li>
        <!-- <li><a href="{{url('/stage-three-pin')}}"><i class="fa fa-circle-o"></i>Generate Stage 3 Pin <span class="badge">*</span> </a></li> -->
       

    </ul>
</li>

<li class="treeview">
    
    <a href="#">
        <i class="fa fa-ticket"></i>
        <span>Ticket Support</span>
        <span class="label label-success">New</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/tickets')}}"><i class="fa fa-circle-o"></i>View Tickets</a></li>
        <li><a href="{{url('/new_ticket')}}"><i class="fa fa-circle-o"></i>Create Ticket</a></li>
        <li><a href="{{url('/my_tickets')}}"><i class="fa fa-circle-o"></i>My Tickets</a></li>

    </ul>
</li>











<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Account Admin</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        
        <li><a href="{{url('/showdeduct')}}"><i class="fa fa-circle-o"></i>Deduct users money</a></li>
        <li><a href="{{url('/calculatecurrentamount')}}"><i class="fa fa-circle-o"></i>Calculate users total</a></li>
        <li><a href="{{url('/system-account-details')}}"><i class="fa fa-circle-o"></i>Calculate Members Financial Record</a></li>        
        <li><a href="{{url('/showpayouts')}}"><i class="fa fa-circle-o"></i>Requested payouts</a></li>
        <li><a href="{{url('/showpaidpayout')}}"><i class="fa fa-circle-o"></i>Paid payouts</a></li>
       
       
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>Admin Functions</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        
    <li><a href="{{url('/showchangepassword')}}"><i class="fa fa-circle-o"></i>change user password</a></li>
        <li><a href="{{url('/mlmsetting')}}"><i class="fa fa-circle-o"></i>Mlm setting</a></li>
        <li><a href="{{url('/appsetting')}}"><i class="fa fa-circle-o"></i>App setting</a></li>
        <li><a href="{{url('/reports')}}"><i class="fa fa-circle-o"></i>Reports</a></li>
        
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-pie-chart"></i>
        <span>User Downlines</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu"> 
        <li><a href="{{url('/viewuserstages')}}"><i class="fa fa-circle-o"></i>View users and stages</a></li>
    </ul>
</li>





<li class="treeview">
    <a href="#">
        <i class="fa fa-ticket"></i>
        <span>Ban User Functions</span>
       
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/banneduserslist')}}"><i class="fa fa-users"></i>show Banned Users</a></li>
        <li><a href="{{url('/banuser')}}"><i class="fa fa-lock"></i>Ban User</a></li>

    </ul>
</li>

                      
@elseif(Auth::user()->role=='user'||Auth::user()->role=='firstuser')
<li class="header">MENU</li>

<li class="" id="step1">
    <a href="{{url('/home')}}">
        <i class="fa fa-tachometer-alt"></i><span>Dashboard</span> 
    </a>
</li>


<li class="">
    <a href="{{url('/viewprofile')}}">
        <i class="fa  fa-user"></i> <span>Profile</span> 
    </a>
</li>


<li class="" id="step2">
    <a href="{{url('/addaccount')}}">
        <i class="fa fa-plus"></i> <span>Add Account</span> 
    </a>
</li>
<li class="" id="step1">
    <a href="{{url('/showsubaccounts')}}">
        <i class="fa fa-users"></i> <span>Sub accounts</span> 
    </a>
</li>

<!-- <li class="" >
    <a href="{{url('/downloadform')}}">
        <i class="fa fa-download"></i> <span>Download Award form</span> 
    </a>
</li> -->


<li class="treeview">
    <a href="#">
        <i class="fa fa-wallet"></i>
        <span>E-Wallet</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/viewtransactions')}}"><i class="fa fa-circle-o"></i>Transaction History</a></li>
        <li><a href="{{url('/accountbalance')}}"><i class="fa fa-circle-o"></i>E-wallet Balance</a></li>
        <li><a href="{{url('/transfer')}}"><i class="fa fa-circle-o"></i>E-wallet fund Transfer</a></li>
        
       
        
        <li><a href="{{url('/paidpayout')}}"><i class="fa fa-circle-o"></i>view paid payout</a></li>
        <li><a href="{{url('/pendingpayout')}}"><i class="fa fa-circle-o"></i>View pending payout</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-network-wired"></i>
        <span>Genelogy</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      
        <li><a href="{{url('/showdownlines')}}"><i class="fa fa-circle-o"></i>Stage Matrix Tree</a></li>
        <li><a href="{{url('/showmemberstree')}}"><i class="fa fa-circle-o"></i>Team members Tree</a></li>
        <li><a href="{{url('/showmemberstablegraph/1/100')}}"><i class="fa fa-circle-o"></i>View Members in Table</a></li>
        <!--<li><a href="{{url('/showmemberstable')}}"><i class="fa fa-circle-o"></i>View Members in Table</a></li>-->
        

    </ul>
</li>


 





<li class="treeview">
    <a href="#">
        <i class="fa fa-file-invoice-dollar"></i>
        <span>Income Report</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/accountbalance')}}"><i class="fa fa-circle-o"></i>Referral Bonus Report</a></li>
        <li><a href="{{url('/accountbalance')}}"><i class="fa fa-circle-o"></i>Stage Completion Income Report</a></li>
        <!--<li><a href="{{url('')}}"><i class="fa fa-circle-o"></i>Matching Income Report</a></li>-->
        <li><a href="{{url('/accountbalance')}}"><i class="fa fa-circle-o"></i>Level Bonus</a></li>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-bullhorn"></i>
        <span>Marketing Tool</span>
      
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('/showreferrallink')}}"><i class="fa fa-circle-o"></i>Referral link</a></li>
    </ul>
</li>









@elseif(Auth::user()->role=='shopadmin')
<li class="header">MENU</li>

<li class="">
    <a href="{{url('/showchangepassword')}}"><i class="fa fa-users"></i>Change Password</a>

</li>
<li class="">
    <a href="{{url('/showchangetransactionpassword')}}"><i class="fa fa-users"></i>Change Transactions Password</a>

</li>
<li class="">
    <a href="{{url('/admin-operation')}}"><i class="fa fa-gear"></i>Operations</a>

</li> 
            
@endif
