@extends('layouts.app')

@section('title', $ticket->title)

@section('content')
   <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">NEW Ticket</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="col-md-10">


                <div class="panel-heading">
                    <h4> #{{ $ticket->ticket_id }} - {{ $ticket->title }}</h4>
                    <br/>
                    <h4>Owner MembershipId {{$membershipid}}</h4>
                </div>

                <div class="panel-body">
                    @include('includes.flash')

                    <div class="ticket-info">
                        <p>{!!$ticket->message!!}</p>
                        <p>Categry: {{ $category->name }}</p>
                        <p>
                        @if ($ticket->status === 'Open')
                            Status: <span class="label label-success">{{ $ticket->status }}</span>
                        @else
                            Status: <span class="label label-danger">{{ $ticket->status }}</span>
                        @endif
                        </p>
                        <p>Created on: {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>

                    <hr>
                        @if ($comments->isEmpty())
                            <p>No replies on this ticket.</p>
                        @else
                            <h3>Replies</h3>
                        @endif

                    <div class="comments">
                        @foreach ($comments as $comment)
                            <div class="panel panel-@if($ticket->user->id === $comment->user_id)
                                {{"default"}}@else{{"success"}}@endif">
                                
                                <div class="panel panel-heading">
                                    {{ $comment->user->name }}
                                    <span class="pull-right">
                                        {{ $comment->created_at->format('Y-m-d') }}
                                    </span>
                                </div>

                                <div class="panel panel-body">
                                    {!! $comment->comment !!}     
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="comment-form">
                        <h4>Reply</h4>
                        <form action="{{ url('comment') }}" method="POST" class="form">
                            {!! csrf_field() !!}

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <textarea rows="5" id="comment" class="form-control" placeholder="Enter Your Reply Here" name="comment">
                                    
                                </textarea>

                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>
                                            {{ $errors->first('comment') }}
                                        </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                    </div>


            </div>
        </div>
        </div>
        </section>

<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>        
<script type="text/javascript">    
CKEDITOR.replace('comment',{
    uiColor: '#9AB8F3',
    toolbar: 'Full',
    enterMode : CKEDITOR.ENTER_BR,
    shiftEnterMode: CKEDITOR.ENTER_P
});  
</script>
@endsection