<html>
<head>
    <title></title>
</head>
<body>

<div class="col-md-">
    {{--@foreach($memberawardorder as $ma)--}}
        {{--@foreach($ma->order_details->items as $item)--}}
            {{--<td>{{$item['qty']}}</td>--}}
            {{--<td>{{$item['item']['product']['item_name']}}</td>--}}
            {{--<td>{{$item['product']['item_name']}}</td>--}}
        {{--@endforeach--}}
    {{--@endforeach--}}

    @foreach($memberawardorder as $ma)
                <div class="panel">
                    <div class="panel panel-heading bg-aqua-gradient">
                        <h3 class="">{{$ma->member->username}}</h3>
                    </div>
                    <div class="panel panel-body">
                        <p><h4> Full Name :{{$ma->member->firstname}} {{$ma->member->middlename}} {{$ma->member->lastname}}</h4></p>
                        <p><h4>{{$ma->member->stage}}</h4></p>
                        <p><h5>{{$ma->award_category->name}}</h5></p>
                    </div>
                </div>
</div>
<div class="col col-md-3">
    <button class="btn btn-large">SUBMIT</button>
</div>

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr>
                    <th>S/No</th>
                    <th>product</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>


                        @foreach($ma->order_details->items as $item)
                            <tr>
                            <td><?= ++$i; ?></td>
                            <td>{{$item['product']['item_name']}}</td>
                            <td>{{$item['qty']}}</td>

                                <a href="#" title="View " class="btn btn-primary">View</a>
                                {{--<a onclick="return confirm('Are You Sure Want to Delete?');" href="{{url('/product-delete/')}}/{!!$prod->id!!}" title="Delete {!!$prod->item_name!!}" class="btn btn-danger">Delete</a>--}}
                            </td>
                            </tr>
                        @endforeach

                @endforeach




    </tbody>

</table>



</body>
</html>