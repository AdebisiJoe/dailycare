@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Account Details</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">


      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>Payout  Id</th>
            <th>User Id</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Action</th>
            <th>Date Requested</th>
          </tr>
        </thead>
        <tbody>                               


         @foreach($payouts as $payout)
         <tr>

           <td>{!!$payout->id!!}</td>
           <td id="">{!!$payout->userid!!}</td>
           <td>{!!$payout->amount!!}</td> 
           <td id="status_{{$payout->userid}}_{{$payout->id}}">{!!$payout->status!!}</td> 
           <td>
             <select class="form-control" onchange="setstatus(this);" >
               <option class="0" disabled="true" selected="true">--Status--</option>
               <option class="1" value="pending_{{$payout->userid}}_{{$payout->id}}">Pending</option>
               <option class="2" value="paid_{{$payout->userid}}_{{$payout->id}}">Paid</option>

              
             </select>

            
           </td> 
           <td>{!!$payout->created!!}</td> 
         </tr>          
         @endforeach

       </tbody>

     </table>
     <div class="pagination"> {{ $payouts->links() }} </div>
   </div>
 </div>
</section>
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('scripts')
<script type="text/javascript">
    function setstatus(sel) {
        
        var setpayoutstatusurl="{{url('/')}}/setpayoutstatus";
        //var savetocarturl="{{url('/')}}/add-to-cart/" + productid;
      
         
        var status =sel.value;
        alert(status);
        statusarray = status.split("_");
        var realstaus=statusarray[0];
        var theuserid=statusarray[1];
        var theid=statusarray[2];
        var formdata={status:realstaus,userid:theuserid,id:theid};
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
          $.ajax({
            type:"POST",
            url:setpayoutstatusurl,
            data:formdata,
            dataType:'json',
            success:function(data){
                
                var json=data;
                console.log(json);
                
                $('#status_'+theuserid+'_'+theid).html('<p>'+json.newstatus+'<p>');
           
               
                

            }
        });
    }

</script>

@endsection


