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
                        <th>Batch Id</th>
                        <th>Requester Name</th>
                        <th>No of pins Requested</th>
                        <th>Status</th>

                        <th>No of Pins Remaining</th>
                        <th>Date Requested</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($pinrequests as $pinrequest)
                        <tr>

                            <td>{!!$pinrequest->batch_id!!}</td>
                            <td>{!!$pinrequest->name!!}</td>
                            <td>{!!$pinrequest->no_of_pins!!}</td>
                            <td>
                            @if($pinrequest->sent==0)
                                    <p>Not Sent</p>
                                @elseif($sent==1)
                                    <p>Some Sent</p>
                                @else
                                    <p>All pins sent</p>
                                @endif
                            </td>

                            <td>{!!$pinrequest->no_remaining_for_batch!!}</td>
                            <td>{{ date('Y-m-d H:i:s',strtotime($pinrequest->created_at))}}</td>


                            <td><a class="btn btn-primary" href="{{url('/adminsendpinrequest')}}/{{$pinrequest->batch_id}}">Send Pin</a></td>

                        </tr>
                    @endforeach

                    </tbody>

                </table>
                <div class="pagination"> {!! $pinrequests->links() !!}  </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')



@endsection


