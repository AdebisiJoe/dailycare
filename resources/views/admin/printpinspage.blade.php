@extends('layouts.app')
@section('stylesheet')

@endsection
@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">change users password</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Number of pins to Print</label>
                        <input type="text" class="form-control" id="inputnumber2" placeholder="Enter Number of Pins to Print">
                    </div>

                    <!-- <div class = "col-md-6">
                         <label for = "">Account Type</label>


                         <select id="registernum2" name="registernum" class="form-control">
                            <option value="1">1</option>
                            <option value="3">3</option>
                            <option value="7">7</option>
                        </select>

                    </div>-->


                    <div class="col-md-12">
                        <button style="margin-top:15px" type="submit2" id="submit2" class="btn btn-danger">Print Pin</button>

                    </div>
                    <div class="col-md-offset-2 col-md-8" style="margin-top:20px">
                        <div   id="printable">
                               <span id="pinvalue2">

                               </span>
                        </div>
                        <div class="col-md-12" id="toprint">
                            <button id="print" class="print btn btn-danger"> Send to printer</button>
                        </div>


                    </div>


                </div>

            </div>
        </div>
    </section>
    <meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('scripts')
    <script type = "text/javascript">
        //Initialize Select2 Elements
        $(".select2").select2();



        $(document).ready(function() {

            $("#submit2").click(function (e) {
                //var formdata={email:$("input#InputEmail").val(),accounttype:$("select#registernum").val()};
                $("#pinvalue2").empty();
                var formdata={number:$("#inputnumber2").val(),accounttype:$("#registernum2").val()};

                $("#pinvalue").html("<img src='{{asset('images/availableimg/ajax-loader.gif') }}'/>");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                        type:"POST",
                        url:"{!!URL::route('printpins')!!}",
                        data:formdata,
                        dataType:'json',
                        success:function(data){
                            //$("#user-result").html(data);
                            console.log(data);



                           /* var i = 0;
                            var table = '<br/>';
                            table +=(' <table class="table">');
                            table +=('<thead>');

                            table += ('</thead>');
                            table += ('<tbody>');
                            //data = $.parseJSON(data)



                            $.each(data, function (index, item) {
                                table += ('<tr style="font-size:25px;font-weight: bold;">');
                                table += ('<th>SERIAL NO</th>');
                                table += ('<th>MEMBERSHIP ID</th> ');
                                table += ('<th>PIN</th>');
                                table += ('</tr>');
                                table += ('</tr>');
                                table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].id + '</td>');
                                table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].membershipid+ '</td>');
                                table += ('<td style="font-size:25px;font-weight: bold;">' + data[index].pin + '</td>');
                                table += ('</tr>');


                            });
                            table += ('</tbody>');
                            table += ('</table>');*/


                            $("#pinvalue2").html(data.data);

                        }
                    }
                );
            });
        });
    </script>
    <script type="text/javascript">


        $(document).ready(function () {

            $("#print").click(function(){
                $("#printable").printMe(
                    { "path": ["{{ asset('bootstrap/css/bootstrap.min.css') }}"],
                        "title": "REGISTRATION PINS"
                    }

                );
            });



        });



    </script>


@endsection


