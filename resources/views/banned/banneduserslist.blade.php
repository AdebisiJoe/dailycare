@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Banned Users</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">


                <table class="table table-striped table-bordered table-hover" >
                    <thead>
                    <tr>

                        <th>Name</th>
                        <th>Username</th>
                        <th>Membership</th>

                        <th>Banned Date</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($bannedusers as $banneduser)
                        <tr>

                            <td>{!!$banneduser->name!!}</td>
                            <td>{!!$banneduser->username!!}</td>
                            <td>{!!$banneduser->membershipid!!}</td>

                            <td >{!!$banneduser->banned_date!!}</td>

                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </section>

@endsection
@section('scripts')



@endsection


