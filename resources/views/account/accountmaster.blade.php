@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        
            <div class="box-header with-border">
                <h3 class="box-title">Account</h3>
            </div><!-- /.box-header -->
            <!-- /.row -->
            <div class="row">
                <div class="col-md-offset-1  col-md-10">
        

  
                            <div class="col-md-3">
                                <div class="tile2">
                                    <div class="col-md-8">
                                        <i class="fa fa-files-o fa-4x"></i>
                                    </div>

                                <a href="{{url('/accountbalance')}}" class="btn btn-danger">Wallet Balance</a>
                                </div>
                            </div>
                           <!--  <div class="col-md-3">
                                <div class="tile2">
                                    <div class="col-md-12">
                                        <i class="fa fa-files-o fa-4x"></i>
                                    </div>

                                    <a href="{{url('/transfer')}}" class="btn btn-danger">Transfer Money</a>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="tile2">
                                    <div class="col-md-12">
                                        <i class="fa fa-files-o fa-4x"></i>
                                    </div>
                                    <a href="{{url('/viewtransactions')}}" class="btn btn-danger">My Transactions</a>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="tile2">
                                    <div class="col-md-12">
                                        <i class="fa fa-files-o fa-4x"></i>
                                    </div>
                                    <a href="{{url('/fundaccount')}}" class="btn btn-danger">Fund account</a>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="tile2">
                                    <div class="col-md-12">
                                        <i class="fa fa-files-o fa-4x"></i>
                                    </div>
                                    <a href="{{url('/payoutcash')}}" class="btn btn-danger">Payout cash</a>
                                </div>
                            </div>

                            
                </div>
            </div>


        
       </div>
    </div>
</div>
@endsection
