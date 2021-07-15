@extends('layouts.app')
@section('stylesheet')
<style type="text/css">
  @media print {
    .page-break { display: block; page-break-before: always; }
  }
</style>
@endsection
@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Operations</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->

      <div class="box-body">
          <div class="nav-tabs-custom">
              <ul class="nav nav-tabs nav-horizontal">
                  <li class="active"><a href="#tab_0" data-toggle="tab" aria-expanded="true">User Information</a></li>
                  {{--<li><a href="#tab_1" data-toggle="tab" aria-expanded="true">Food Collection</a></li>--}}
                  {{--<li><a href="#tab_2" data-toggle="tab" aria-expanded="false">Create Group</a></li>--}}
                  {{--<li><a href="#tab_3" data-toggle="tab" aria-expanded="false">PIN Issues</a></li>--}}
                  {{--<li><a href="#tab_4" data-toggle="tab" aria-expanded="false">Edit Product Info</a></li>--}}
              </ul>
              <div class="tab-content">
                  <div class="tab-pane active" id="tab_0">
                      <div role="tabpanel" class="nav-tabs-custom">
                          <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active">
                                  <a href="#userInfo" aria-controls="userInfo" role="tab" data-toggle="tab">Issue User Award</a>
                              </li>
                              <li role="presentation">
                                  <a href="#userParent" aria-controls="userParent" role="tab" data-toggle="tab">View Total award</a>
                              </li>

                              <li role="presentation">
                                  <a href="#userAward" aria-controls="userParent" role="tab" data-toggle="tab">Insert Award</a>
                              </li>
                              {{--<li role="presentation">--}}
                                  {{--<a href="#userDownlines" aria-controls="userDownlines" role="tab" data-toggle="tab">View User Downlines</a>--}}
                              {{--</li>--}}
                              {{--<li role="presentation">--}}
                                  {{--<a href="#userStageMatrix" aria-controls="userStageMatrix" role="tab" data-toggle="tab">View User Matrix</a>--}}
                              {{--</li>--}}
                              {{--<li role="presentation">--}}
                                  {{--<a href="#userAccountBalance" aria-controls="userAccountBalance" role="tab" data-toggle="tab">View User Account Balance</a>--}}
                              {{--</li>--}}
                              {{--<li role="presentation">--}}
                                  {{--<a href="#calculateBonus" aria-controls="calculateBonus" role="tab" data-toggle="tab">Calculate Bonus</a>--}}
                              {{--</li>--}}
                          </ul>

                          <!-- Tab panes -->
                          <div class="tab-content">
                              <!-- View User Information -->
                              <div role="tabpanel" class="tab-pane active" id="userInfo">
                                  <form method="post" action="{{url('/award/admin/operation/getuseraward')}}">
                                      <div class="input-group">
                                          {{csrf_field()}}
                                          <input type="text" placeholder="Enter Membership ID" id="user_id"  name="user_id" class="form-control">

                                          <span class="input-group-btn">
                                <button type="submit" class="btn btn-info" ><span id="spinner1">User Info</span></button>
                            </span>
                                      </div>

                                  </form>
                              </div>
                              <!-- View User Parent -->
                              <div role="tabpanel" class="tab-pane" id="userParent">
                                  <form method="post" action="{{url('/award/admin/operation/getallstageaward')}}">
                                      <div class="input-group">
                                          {{csrf_field()}}
                                          <select name="award_category_id" class="form-control">
                                              @foreach (\App\AwardCategory::all() as $awardcategory)
                                                  <option value="{!! $awardcategory->id !!}">{!! $awardcategory->name !!}</option>
                                              @endforeach
                                          </select>
                                          <span class="input-group-btn">
                                <button type="submit" class="btn btn-info" ><span id="spinner1">User Info</span></button>
                            </span>
                                      </div>

                                  </form>
                              </div>

                              {{--for inputing the users award that is not in the database--}}

                              <div role="tabpanel" class="tab-pane" id="userAward">
                                  <form class="form-horizontal" method="post"  enctype="multipart/form-data" action="{{ url('/create/unentered/award') }}">

                                      {{csrf_field()}}

                                      <div class="form-group required">
                                          <label class="col-sm-2 control-label" for="input-name1">Member Id</label>
                                          <div class="col-sm-10">
                                              <input type="text" name="membershipid" value="" placeholder="Membership Id" id="input-name1" class="form-control" required/>
                                          </div>
                                      </div>

                                      <div class="form-group required">
                                          <label class="col-sm-2 control-label" for="input-name1">Select Award Type</label>
                                          <div class="col-sm-10">
                                              <select name="awardCategory" class="form-control" required>
                                                  @foreach (\App\AwardCategory::all() as $awardCategory)
                                                      <option value="{!! $awardCategory->id !!}">{!! $awardCategory->name !!}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group required">
                                          <label class="col-sm-2 control-label" for="input-name1">Award Months</label>
                                          <div class="col-sm-10" required>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="1">1</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="2">2</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="3">3</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="4">4</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="5">5</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="6">6</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="7">7</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="8">8</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="9">9</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="10">10</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="11">11</label>
                                              <label class="radio-inline"><input type="radio" name="optradio" value="12">Complete</label>
                                          </div>
                                      </div>

                                      <span class="input-group-btn">
                                <button type="submit" class="btn btn-info pull-right" ><span id="spinner1">Save</span></button>
                            </span>
                                  </form>
                              </div>

                              {{--end of inputing the users award that arent in the database--}}
                              <!-- View User Downlines -->
                              {{--<div role="tabpanel" class="tab-pane" id="userDownlines">--}}
                                  {{--<div class="input-group">--}}
                                      {{--<input type="text" placeholder="Enter Membership ID" id="user_id_downlines" class="form-control">--}}
                                      {{--<span class="input-group-btn">--}}
                      {{--<button type="button" class="btn btn-info" onclick="getDownlines()"><span id="spinner_downlines">Get Downlines</span></button>--}}
                    {{--</span>--}}
                                  {{--</div>--}}
                              {{--</div>--}}
                              {{--<!-- View User Stage Matrix -->--}}
                              {{--<div role="tabpanel" class="tab-pane" id="userStageMatrix">--}}
                                  {{--<div class="input-group">--}}
                                      {{--<input type="text" placeholder="Enter Membership ID" id="user_id_matrix" class="form-control">--}}
                                      {{--<span class="input-group-btn">--}}
                      {{--<button type="button" class="btn btn-info" onclick="getUserMatrix()"><span id="spinner_matrix">Get User Matrix</span></button>--}}
                    {{--</span>--}}
                                  {{--</div>--}}
                              {{--</div>--}}
                              {{--<!-- View USer Balance -->--}}
                              {{--<div role="tabpanel" class="tab-pane" id="userAccountBalance">--}}
                                  {{--<div class="input-group">--}}
                                      {{--<input type="text" placeholder="Enter Membership ID" id="user_id_balance" class="form-control">--}}
                                      {{--<span class="input-group-btn">--}}
                      {{--<button type="button" class="btn btn-info" onclick="getUserAccountBalance()"><span id="spinner_balace">Get User Account Balance</span></button>--}}
                    {{--</span>--}}
                                  {{--</div>--}}
                              {{--</div>--}}
                              {{--<!-- Calculate User Bonus -->--}}
                              {{--<div role="tabpanel" class="tab-pane" id="calculateBonus">--}}
                                  {{--<b>NOT YET AVAILABLE</b>--}}
                              {{--</div>--}}
                          </div>
                      </div>
                  </div>
                  {{--<div class="tab-pane" id="tab_1">--}}
                      {{--<div role="tabpanel" class="nav-tabs-custom">--}}
                          {{--<!-- Nav tabs -->--}}
                          {{--<ul class="nav nav-tabs" role="tablist">--}}
                              {{--<li role="presentation" class="active">--}}
                                  {{--<a href="#food_form" aria-controls="food_form" role="tab" data-toggle="tab">Form</a>--}}
                              {{--</li>--}}
                              {{--<li role="presentation">--}}
                                  {{--<a href="#food_log" aria-controls="food_log" role="tab" data-toggle="tab">Log</a>--}}
                              {{--</li>--}}
                          {{--</ul>--}}

                          {{--<!-- Tab panes -->--}}
                          {{--<div class="tab-content">--}}
                              {{--<div role="tabpanel" class="tab-pane active" id="food_form">--}}
                                  {{--<div class="row">--}}
                                      {{--<div class="form-group">--}}
                                          {{--<label for="input" class="col-sm-2 control-label">Enter Membership ID:</label>--}}
                                          {{--<div class="col-sm-10">--}}
                                              {{--<input type="text" name="" placeholder="Membership ID" id="buyer_id" id="input" class="form-control" required="required">--}}
                                          {{--</div>--}}
                                      {{--</div>--}}
                                  {{--</div>--}}
                                  {{--<br>--}}
                                  {{--<div class="row">--}}
                                      {{--<div class="form-group">--}}
                                          {{--<label for="input" class="col-sm-2 control-label">Group Leader:</label>--}}
                                          {{--<div class="col-sm-10">--}}
                                              {{--<select name="" id="group-leader-id" id="input" class="form-control" required="required">--}}
                                                  {{--<option value="-1" selected>--Select Group Leader--</option>--}}
                                              {{--</select>--}}
                                          {{--</div>--}}
                                      {{--</div>--}}
                                  {{--</div>--}}
                                  {{--<br>--}}
                                  {{--<div class="row">--}}
                                      {{--<div class="col-md-12">--}}
                                          {{--<table class="table table-hover">--}}
                                              {{--<meta name="_token" content="{!! csrf_token() !!}" />--}}
                                              {{--<thead>--}}
                                              {{--<tr>--}}
                                                  {{--<th>Item</th>--}}
                                                  {{--<th>Quantity</th>--}}
                                                  {{--<th class="text-right">Price</th>--}}
                                                  {{--<th class="text-right">Action</th>--}}
                                              {{--</tr>--}}
                                              {{--</thead>--}}
                                              {{--<tbody id="items">--}}

                                              {{--</tbody>--}}
                                              {{--<tfoot>--}}
                                              {{--<tr>--}}
                                                  {{--<td></td>--}}
                                                  {{--<td><span id="totalQty"></span></td>--}}
                                                  {{--<td class="text-right"><strong><span id="totalAmount"></span></strong></td>--}}
                                                  {{--<td></td>--}}
                                              {{--</tr>--}}
                                              {{--<tr>--}}
                                                  {{--<td></td>--}}
                                                  {{--<td></td>--}}
                                                  {{--<td></td>--}}
                                                  {{--<td class="text-right">--}}
                                                      {{--<button onclick="addNewItem();" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Add New Item"><i class="fa fa-plus"></i></button>--}}
                                                      {{--<button type="button" class="submit btn btn-success" onclick="submitForm()" data-toggle="tooltip" data-placement="top" title="Submit Form"><i class="fa fa-save"></i></button>--}}
                                                  {{--</td>--}}
                                              {{--</tr>--}}

                                              {{--</tfoot>--}}
                                          {{--</table>--}}
                                      {{--</div>--}}
                                  {{--</div>--}}
                              {{--</div>--}}
                              {{--<div role="tabpanel" class="tab-pane" id="food_log">--}}
                                  {{--<div class="input-group">--}}
                                      {{--<input type="text" placeholder="Enter Membership ID" id="user_id_food_log" class="form-control">--}}
                                      {{--<span class="input-group-btn">--}}
                      {{--<button type="button" class="btn btn-info" onclick="getUserFoodCollectionLog()"><span id="spinner_food_log">Get User Food Collection Log</span></button>--}}
                    {{--</span>--}}
                                  {{--</div>--}}
                              {{--</div>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<!-- </div> -->--}}
                  {{--</div>--}}
                  {{--<!-- /.tab-pane -->--}}
                  {{--<div class="tab-pane" id="tab_2">--}}
                      {{--<div class="nav-tabs-custom">--}}
                          {{--<ul class="nav nav-tabs">--}}
                              {{--<li class="active"><a href="#tab_grp" data-toggle="tab" aria-expanded="true">All Groups</a></li>--}}
                              {{--<li class=""><a href="#tab_create" data-toggle="tab" aria-expanded="false">Create Group</a></li>--}}
                          {{--</ul>--}}
                          {{--<div class="tab-content">--}}
                              {{--<div class="tab-pane active" id="tab_grp">--}}
                                  {{--<table class="table table-bordered">--}}
                                      {{--<thead>--}}
                                      {{--<tr>--}}
                                          {{--<th style="width: 10px">#</th>--}}
                                          {{--<th>Owner ID <i class="loader"></th>--}}
                                          {{--<th>Group Name <i class="loader"></th>--}}
                                          {{--<th>Action <i class="loader"></th>--}}
                                      {{--</tr>--}}
                                      {{--</thead>--}}
                                      {{--<tbody id="list-of-groups">--}}

                                      {{--</tbody>--}}
                                  {{--</table>--}}
                              {{--</div>--}}
                              {{--<!-- /.tab-pane -->--}}
                              {{--<div class="tab-pane" id="tab_create">--}}
                                  {{--<div class="form-horizontal">--}}
                                      {{--<div class="box-body">--}}
                                          {{--<div class="form-group">--}}
                                              {{--<label for="inputOwnerID" class="col-sm-2 control-label">Owner ID </label>--}}

                                              {{--<div class="col-sm-10">--}}
                                                  {{--<input type="text" class="form-control" id="inputOwnerID" placeholder="Owner ID">--}}
                                              {{--</div>--}}
                                          {{--</div>--}}
                                          {{--<div class="form-group">--}}
                                              {{--<label for="inputGroupName" class="col-sm-2 control-label">Group Name</label>--}}

                                              {{--<div class="col-sm-10">--}}
                                                  {{--<input type="text" class="form-control" id="inputGroupName" placeholder="Group Name">--}}
                                              {{--</div>--}}
                                          {{--</div>--}}
                                      {{--</div>--}}
                                      {{--<!-- /.box-body -->--}}
                                      {{--<div class="box-footer">--}}
                                          {{--<button type="button" data-loading-text="Creating Group" data-done-text="Group Created" data-reset-text="Create Group" class="btn btn-success pull-right" onclick="createGroup()"><i class="fa fa-save"></i>&nbsp;<span id="spinner">Create Group</span></button>--}}
                                      {{--</div>--}}
                                      {{--<!-- /.box-footer -->--}}
                                  {{--</div>--}}
                              {{--</div>--}}
                              {{--<!-- /.tab-pane -->--}}
                          {{--</div>--}}
                          {{--<!-- /.tab-content -->--}}
                      {{--</div>--}}
                  {{--</div>--}}

                  {{--<div class="tab-pane" id="tab_3">--}}
                      {{--<div role="tabpanel" class="nav-tabs-custom">--}}
                          {{--<!-- Nav tabs -->--}}
                          {{--<ul class="nav nav-tabs nav-horizontal" role="tablist">--}}
                              {{--<li role="presentation" class="active">--}}
                                  {{--<a href="#home" aria-controls="home" role="tab" data-toggle="tab">Check PIN Status</a>--}}
                              {{--</li>--}}
                              {{--<li role="presentation">--}}
                                  {{--<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">Re-print PIN</a>--}}
                              {{--</li>--}}
                          {{--</ul>--}}

                          {{--<!-- Tab panes -->--}}
                          {{--<div class="tab-content">--}}
                              {{--<div role="tabpanel" class="tab-pane active" id="home">--}}
                                  {{--<br>--}}
                                  {{--<div class="input-group">--}}
                                      {{--<input type="text" id="pin_id" placeholder="Enter Membership ID" class="form-control">--}}
                                      {{--<span class="input-group-btn">--}}
                      {{--<button type="button" class="btn btn-info" onclick="getPINStatus()"><span id="spinner3">Check PIN Status</span></button>--}}
                    {{--</span>--}}
                                  {{--</div>--}}

                              {{--</div>--}}
                              {{--<div role="tabpanel" class="tab-pane" id="tab">--}}
                                  {{--<br>--}}
                                  {{--<div class="input-group">--}}
                                      {{--<input type="text" id="pin_range" placeholder="Enter PIN ID Range e.g (300-305)" class="form-control">--}}
                                      {{--<span class="input-group-btn">--}}
                      {{--<button type="button" class="btn btn-info" onclick="getPINReprint()"><span id="spinner4">View PIN Re-print</span></button>--}}
                    {{--</span>--}}
                                  {{--</div>--}}

                              {{--</div>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                  {{--</div>--}}

                  {{--<div class="tab-pane" id="tab_4">--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="input_products">Select Product</label>--}}
                          {{--<select name="" id="input_products" class="form-control" required="required" onchange="loadProductInfo()">--}}
                          {{--</select>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="prodName">Product Name</label>--}}
                          {{--<input type="text" class="form-control" id="prodName" placeholder="Product Name">--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="prodPrice">Product Price</label>--}}
                          {{--<input type="number"  onkeypress="return numbersonly(event);" class="form-control" id="prodPrice" placeholder="Product Price">--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<button type="button" id="update-prod-info" onclick="updateProdInfo()" class="btn btn-info"><span id="spinner_product">Update Product Information</span></button>--}}
                      {{--</div>--}}
                  {{--</div>--}}
                  <!-- /.tab-pane -->
              </div>

              <!-- /.tab-content -->
          </div>

      </div>
 </div>
      <!-- Load Result Here -->
<div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Results</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" onclick="printReport('reportForm')"><i class="fa fa-print"></i></button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->

    <div class="box-body">
      <div id="result" class="reportForm">

          {{--@if(empty($memberawardorder) || $memberawardorder==null)--}}
              {{--<p>Insert Customer MembershipId At the top</p>--}}
          @if(!empty($allmembersawardorder))
              <div class="row">
                  <div class="col-md-8">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                          <thead>
                          <tr>
                              <th width="5%">S/No</th>
                              <th width="15">Name</th>
                              <th width="15">MemberId</th>
                              <th width="60%">products and Quantity</th>
                              {{--<th>Quantity</th>--}}
                          </tr>
                          </thead>
                          <tbody>
                          <?php $i = 0; ?>

                          {{--$allmembersawardorder == $amao(derived it from the first letter of each word)--}}
                          @foreach($allmembersawardorder as $amao)
                              <tr>
                                  <td><?= ++$i; ?></td>
                                  <td>{{$amao->member->username}}</td>
                                  <td>{{$amao->membership_id}}</td>
                                  <td>
                                      <table>
                                          <?php $x=0; ?>
                                          @foreach($amao->order_details->items as $item)

                                              @if($item['item']['good_type']=='fooditem')

                                                  <tr>
                                                      <td width="80%">{{$item['product']['item_name']}}</td>
                                                      <td width="5%"><span class="badge">{{$item['qty']}}</span></td>
                                                  </tr>
                                              @endif

                                              @if($item['item']['good_type']=='accessories')
                                                      <tr>
                                                          <td width="80%">{{$item['product']['name']}}</td>
                                                          <td width="5%"><span class="badge">{{$item['qty']}}</span></td>
                                                      </tr>
                                               @endif
                                          @endforeach
                                      </table>
                                  </td>

                              </tr>

                          @endforeach

                          </tbody>

                      </table>

                  </div>
                  @if(!empty($totalforeachproduct))
                      <div class="col-md-3">
                          <div class="panel">
                              <div class="panel panel-heading">
                                  <h4>Total Products</h4>
                              </div>
                              <div class="panel panel-body">
                                  @foreach($totalforeachproduct as $total)
                                      <p><h4>{{$total['name']}} &amp;<span class="badge">{{$total['qty']}}</span></h4></p>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  @endif
              </div>
          @endif

          @if(!empty($memberawardorder))
              <div class="row">
                  <div class="col-md-9">
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

                  <div class="col-md-3">
                      <form method="post" action="{{url('/award/admin/issue/user')}}">
                          <div class="input-group">
                              {{csrf_field()}}
                              <input type="hidden" value="{{$ma->id}}" name="id">
                              <input type="hidden" value="{{$ma->membership_id}}" name="membership_id">
                              <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-lg" ><span id="spinner1">Issue User Food</span></button>
                              </span>
                          </div>
                      </form>
                  </div>
              </div>

              <div class="row">
                    <div class="col-md-9">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>S/No</th>
                                <th>product</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>


                            @foreach($ma->order_details->items as $item)
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    @if($item['item']['good_type']=='fooditem')
                                        <td>{{$item['product']['item_name']}}</td>
                                        <td>{{$item['qty']}}</td>
                                    @endif
                                    @if($item['item']['good_type']=='accessories')
                                        <td>{{$item['product']['name']}}</td>
                                        <td>{{$item['qty']}}</td>
                                    @endif
                                    {{--<a onclick="return confirm('Are You Sure Want to Delete?');" href="{{url('/product-delete/')}}/{!!$prod->id!!}" title="Delete {!!$prod->item_name!!}" class="btn btn-danger">Delete</a>--}}
                                    </td>
                                </tr>
                            @endforeach

                            @endforeach






                            </tbody>

                        </table>

                    </div>
                </div>

          @else
              {{--@if(empty($memberawardorder) || $memberawardorder==null)--}}
              <p>Insert Customer MembershipId At the top</p>

          @endif


      </div>
    </div>
</div>
</section>

@endsection
@section('scripts')
    {{--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>--}}

    {{--<script src="{{asset('/assets/ayax/axios/dist/axios.min.js')}}"></script>--}}
    {{--<script src="{{ asset('vjs/vue.js') }}"></script>--}}

    {{--<script src="../../assets/jsvue/components/main.js"></script>--}}

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
        $(document).ready(function () {
            $('#dataTables-example1').DataTable({
                responsive: true
            });
        });

        $(document).ready(function() {



        });
    </script>



    <script type="text/javascript">


        function printReport(divName) {
            $("." + divName).printThis({
                "importStyle": true,
                "loadCSS": "{{ asset('bootstrap/css/bootstrap.min.css') }}",
            });
        }
    {{--var token= "{{ csrf_token() }}";--}}
    {{--var pathname ="{{url('/award/admin/operation/getuseraward')}}";--}}

    {{--Vue.component('result', {--}}

    {{--});--}}


    {{--new Vue({--}}

        {{--el:'#user',--}}

        {{--data:{--}}
            {{--username:'',--}}
            {{--dataset:''--}}
        {{--},--}}

{{--//        computed:{--}}
{{--//            ckk:function () {--}}
{{--//                this.dataset--}}
{{--//            }--}}
{{--//        },--}}

        {{--methods:{--}}
            {{--test:function () {--}}
{{--//                console.log(this.username);--}}
                {{--axios.post(pathname, {user_id:this.username})--}}
                    {{--.then( response=> {--}}
                    {{--this.dataset = response.data;--}}
                {{--console.log(response.data);--}}

            {{--});--}}
            {{--},--}}



            {{--test:function () {--}}
                {{--$.ajax({--}}
                    {{--url: '{{ url("/")}}/award/admin/operation/getuseraward',--}}
                    {{--type: 'post',--}}
                    {{--data: {--}}
                        {{--"_token": "{{ csrf_token() }}",--}}
                        {{--"user_id": this.username,--}}
                    {{--},--}}
                    {{--dataType: 'html',--}}
                    {{--beforeSend: function () {--}}
                        {{--$('#spinner1').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Loading User Info...');--}}
                    {{--},--}}
                    {{--complete: function () {--}}
                        {{--$('#spinner1').html('Get user Info');--}}
                    {{--},--}}
                    {{--success: function (data) {--}}
{{--//                     $('#result').html(data);--}}
                        {{--console.log(data);--}}
                        {{--this.dataset=data--}}
                    {{--}--}}
                {{--})--}}

            {{--}--}}
        {{--}--}}


    {{--})--}}

</script>

<script type="text/javascript">
  /*
   * printThis v1.9.0
   * @desc Printing plug-in for jQuery
   * @author Jason Day
   *
   * Resources (based on) :
   *              jPrintArea: http://plugins.jquery.com/project/jPrintArea
   *              jqPrint: https://github.com/permanenttourist/jquery.jqprint
   *              Ben Nadal: http://www.bennadel.com/blog/1591-Ask-Ben-Print-Part-Of-A-Web-Page-With-jQuery.htm
   *
   * Licensed under the MIT licence:
   *              http://www.opensource.org/licenses/mit-license.php
   *
   * (c) Jason Day 2015
   *
   * Usage:
   *
   *  $("#mySelector").printThis({
   *      debug: false,               * show the iframe for debugging
   *      importCSS: true,            * import page CSS
   *      importStyle: false,         * import style tags
   *      printContainer: true,       * grab outer container as well as the contents of the selector
   *      loadCSS: "path/to/my.css",  * path to additional css file - us an array [] for multiple
   *      pageTitle: "",              * add title to print page
   *      removeInline: false,        * remove all inline styles from print elements
   *      printDelay: 333,            * variable print delay
   *      header: null,               * prefix to html
   *      footer: null,               * postfix to html
   *      base: false,                * preserve the BASE tag, or accept a string for the URL
   *      formValues: true            * preserve input/form values
   *      canvas: false               * copy canvas elements (experimental)
   *      doctypeString: '...'        * enter a different doctype for older markup
   *  });
   *
   * Notes:
   *  - the loadCSS will load additional css (with or without @media print) into the iframe, adjusting layout
   */
  ;
  (function($) {
      var opt;
      $.fn.printThis = function(options) {
          opt = $.extend({}, $.fn.printThis.defaults, options);
          var $element = this instanceof jQuery ? this : $(this);

          var strFrameName = "printThis-" + (new Date()).getTime();

          if (window.location.hostname !== document.domain && navigator.userAgent.match(/msie/i)) {
              // Ugly IE hacks due to IE not inheriting document.domain from parent
              // checks if document.domain is set by comparing the host name against document.domain
              var iframeSrc = "javascript:document.write(\"<head><script>document.domain=\\\"" + document.domain + "\\\";</s" + "cript></head><body></body>\")";
              var printI = document.createElement('iframe');
              printI.name = "printIframe";
              printI.id = strFrameName;
              printI.className = "MSIE";
              document.body.appendChild(printI);
              printI.src = iframeSrc;

          } else {
              // other browsers inherit document.domain, and IE works if document.domain is not explicitly set
              var $frame = $("<iframe id='" + strFrameName + "' name='printIframe' />");
              $frame.appendTo("body");
          }


          var $iframe = $("#" + strFrameName);

          // show frame if in debug mode
          if (!opt.debug) $iframe.css({
              position: "absolute",
              width: "0px",
              height: "0px",
              left: "-600px",
              top: "-600px"
          });

          // $iframe.ready() and $iframe.load were inconsistent between browsers    
          setTimeout(function() {

              // Add doctype to fix the style difference between printing and render
              function setDocType($iframe,doctype){
                  var win, doc;
                  win = $iframe.get(0);
                  win = win.contentWindow || win.contentDocument || win;
                  doc = win.document || win.contentDocument || win;
                  doc.open();
                  doc.write(doctype);
                  doc.close();
              }
              if(opt.doctypeString){
                  setDocType($iframe,opt.doctypeString);
              }

              var $doc = $iframe.contents(),
                  $head = $doc.find("head"),
                  $body = $doc.find("body"),
                  $base = $('base'),
                  baseURL;

              // add base tag to ensure elements use the parent domain
              if (opt.base === true && $base.length > 0) {
                  // take the base tag from the original page
                  baseURL = $base.attr('href');
              } else if (typeof opt.base === 'string') {
                  // An exact base string is provided
                  baseURL = opt.base;
              } else {
                  // Use the page URL as the base
                  baseURL = document.location.protocol + '//' + document.location.host;
              }

              $head.append('<base href="' + baseURL + '">');

              // import page stylesheets
              if (opt.importCSS) $("link[rel=stylesheet]").each(function() {
                  var href = $(this).attr("href");
                  if (href) {
                      var media = $(this).attr("media") || "all";
                      $head.append("<link type='text/css' rel='stylesheet' href='" + href + "' media='" + media + "'>");
                  }
              });
              
              // import style tags
              if (opt.importStyle) $("style").each(function() {
                  $(this).clone().appendTo($head);
              });

              // add title of the page
              if (opt.pageTitle) $head.append("<title>" + opt.pageTitle + "</title>");

              // import additional stylesheet(s)
              if (opt.loadCSS) {
                 if( $.isArray(opt.loadCSS)) {
                      jQuery.each(opt.loadCSS, function(index, value) {
                         $head.append("<link type='text/css' rel='stylesheet' href='" + this + "'>");
                      });
                  } else {
                      $head.append("<link type='text/css' rel='stylesheet' href='" + opt.loadCSS + "'>");
                  }
              }

              // print header
              if (opt.header) $body.append(opt.header);

              if (opt.canvas) {
                  // add canvas data-ids for easy access after the cloning.
                  var canvasId = 0;
                  $element.find('canvas').each(function(){
                      $(this).attr('data-printthis', canvasId++);
                  });
              }

              // grab $.selector as container
              if (opt.printContainer) $body.append($element.outer());

              // otherwise just print interior elements of container
              else $element.each(function() {
                  $body.append($(this).html());
              });

              if (opt.canvas) {
                  // Re-draw new canvases by referencing the originals
                  $body.find('canvas').each(function(){
                      var cid = $(this).data('printthis'),
                          $src = $('[data-printthis="' + cid + '"]');

                      this.getContext('2d').drawImage($src[0], 0, 0);

                      // Remove the mark-up from the original
                      $src.removeData('printthis');
                  });
              }

              // capture form/field values
              if (opt.formValues) {
                  // loop through inputs
                  var $input = $element.find('input');
                  if ($input.length) {
                      $input.each(function() {
                          var $this = $(this),
                              $name = $(this).attr('name'),
                              $checker = $this.is(':checkbox') || $this.is(':radio'),
                              $iframeInput = $doc.find('input[name="' + $name + '"]'),
                              $value = $this.val();

                          // order matters here
                          if (!$checker) {
                              $iframeInput.val($value);
                          } else if ($this.is(':checked')) {
                              if ($this.is(':checkbox')) {
                                  $iframeInput.attr('checked', 'checked');
                              } else if ($this.is(':radio')) {
                                  $doc.find('input[name="' + $name + '"][value="' + $value + '"]').attr('checked', 'checked');
                              }
                          }

                      });
                  }

                  // loop through selects
                  var $select = $element.find('select');
                  if ($select.length) {
                      $select.each(function() {
                          var $this = $(this),
                              $name = $(this).attr('name'),
                              $value = $this.val();
                          $doc.find('select[name="' + $name + '"]').val($value);
                      });
                  }

                  // loop through textareas
                  var $textarea = $element.find('textarea');
                  if ($textarea.length) {
                      $textarea.each(function() {
                          var $this = $(this),
                              $name = $(this).attr('name'),
                              $value = $this.val();
                          $doc.find('textarea[name="' + $name + '"]').val($value);
                      });
                  }
              } // end capture form/field values

              // remove inline styles
              if (opt.removeInline) {
                  // $.removeAttr available jQuery 1.7+
                  if ($.isFunction($.removeAttr)) {
                      $doc.find("body *").removeAttr("style");
                  } else {
                      $doc.find("body *").attr("style", "");
                  }
              }

              // print "footer"
              if (opt.footer) $body.append(opt.footer);

              setTimeout(function() {
                  if ($iframe.hasClass("MSIE")) {
                      // check if the iframe was created with the ugly hack
                      // and perform another ugly hack out of neccessity
                      window.frames["printIframe"].focus();
                      $head.append("<script>  window.print(); </s" + "cript>");
                  } else {
                      // proper method
                      if (document.queryCommandSupported("print")) {
                          $iframe[0].contentWindow.document.execCommand("print", false, null);
                      } else {
                          $iframe[0].contentWindow.focus();
                          $iframe[0].contentWindow.print();
                      }
                  }

                  // remove iframe after print
                  if (!opt.debug) {
                      setTimeout(function() {
                          $iframe.remove();
                      }, 1000);
                  }

              }, opt.printDelay);

          }, 333);

      };

      // defaults
      $.fn.printThis.defaults = {
          debug: false,           // show the iframe for debugging
          importCSS: true,        // import parent page css
          importStyle: false,     // import style tags
          printContainer: true,   // print outer container/$.selector
          loadCSS: "",            // load an additional css file - load multiple stylesheets with an array []
          pageTitle: "",          // add title to print page
          removeInline: false,    // remove all inline styles
          printDelay: 333,        // variable print delay
          header: null,           // prefix to html
          footer: null,           // postfix to html
          formValues: true,       // preserve input/form values
          canvas: false,          // Copy canvas content (experimental)
          base: false,            // preserve the BASE tag, or accept a string for the URL
          doctypeString: '<!DOCTYPE html>' // html doctype
      };

      // $.selector container
      jQuery.fn.outer = function() {
          return $($("<div></div>").html(this.clone())).html();
      }
  })(jQuery);
</script>
@endsection


