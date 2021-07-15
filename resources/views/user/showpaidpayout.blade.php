@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
 <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Paid Payouts</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
      

                <table class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th>Payout  Id</th>
                            <th>User Id</th>
                            <th>Amount</th>
                            <th>Status</th>
                            
                            <th>Date Requested</th>
                            <th>Date Paid</th>
                        </tr>
                    </thead>
                    <tbody>                               
                      
     
       @foreach($payouts as $payout)
         <tr>
        
           <td>{!!$payout->id!!}</td>
           <td>{!!$payout->userid!!}</td>
           <td>{!!$payout->amount!!}</td> 
           <td id="status">{!!$payout->status!!}</td> 
 
           <td>{!!$payout->created!!}</td> 
           <th>{!!$payout->datepaid!!}</th>
           
         </tr>          
         @endforeach

                    </tbody>

                </table>
 <div class="pagination"> {{ $payouts->links() }} </div>
      </div>
    </div>
</section>

@endsection
@section('scripts')



@endsection


