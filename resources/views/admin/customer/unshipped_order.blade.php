@extends('admin.include.master')
 @section('title') Unshipped Order List - Aleshamart @endsection
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6" style="margin-bottom: 15px;">
          <div class="page-header" style="border:none">
            <h3 class="page-title">Customer : {{ $customer_info->fullname }} -- Total Unshipped Order ({{ $customerOrders->count() }})</h3>
        </div>
          @if (session()->has('messageType'))
              <div class="alert alert-{{ session()->get('messageType') }}" role="alert">
                  <strong>STATUS: </strong> {{ session()->get('message') }}
              </div>
          @endif
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Customer</li>
            {{-- <li class="breadcrumb-item active">Customer List</li> --}}
            <li class="breadcrumb-item active">{{ $customer_info->fullname }}</li>
          </ol>
        </div>
        <div class="col-sm-8 breadcrumb pull-right" style="float:right; text-align:right">
          <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm" style="color:#fff; margin-right:10px;">Back</a>
          <a href="{{ route('admin.customer.unshipped_orders', [$customer_info->id]) }}" style="color:#fff; margin-right:10px;" class="btn btn-info btn-sm disabled">Unshipped</a>
          <a href="{{ route('admin.customer.returned_orders', [$customer_info->id]) }}" style="color:#fff; margin-right:10px;" class="btn btn-warning btn-sm">Returned Order</a>
          <a href="{{ route('admin.customer.canceled_orders', [$customer_info->id]) }}" style="color:#fff; margin-right:10px;" class="btn btn-danger btn-sm">Canceled Order</a>
          <a href="{{ route('admin.customer.complete_orders', [$customer_info->id]) }}" style="color:#fff; margin-right:10px;" class="btn btn-success btn-sm">Complete Order</a>
          <a href="{{ route('admin.customer.total_orders', [$customer_info->id]) }}" style="color:#fff; margin-right:10px;" class="btn btn-info btn-sm">Total Order</a>
          {{-- <a  href="{{ route('admin.customer.total_product', [$customer_info->id]) }}" style="color:#fff; margin-right:10px" class="btn btn-primary btn-sm"></i> View All Product</a> --}}
          {{-- <a  href="#" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"></i> Total Order Cancel</a>
          <a href="{{ route('marchent.edit', $customer_info->id) }}" class="btn btn-sm btn-warning" style="margin-right:20px;">Edit <i class="fa fa-edit"></i></a>
          <a  href="javascript:void()" onclick="sellerApproval('marchents','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
          <a  href="javascript:void()" onclick="permissions('marchents','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a> --}}
      </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            {{-- <li class=""><a  href="javascript:void()" onclick="permissions('customers','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li> --}}
            {{-- <li class=""><a  href="javascript:void()" onclick="permissions('customers','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li> --}}
            {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','customers');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
            <li class=""><a  href="{{ route('customer.index') }}" style="color:#fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> View Customer List</a></li>
          </ol>
        </div>

        <div class="col-sm-12">
          <div class="page-header" style="border:none">
            <div class="col-sm-12 pull-right" style="margin:0; padding:0; margin-bottom:20px">
              <input type="text" name="keywords" class="form-control" placeholder="Search by order id"
                                 style="padding:7px; font-size:13px; height:auto; width:25%; float:left; margin-right:1%">

              <select class="form-control" style="width:16%; height:auto; padding:8px; margin-right:1%; float:left" onchange="ajaxOrders(this.value);">
                <option value="0_days"> Today </option>
                <option value="-1_days"> Last day </option>
                <option value="3_days"> Last 3 days </option>
                <option value="7_days" selected="selected"> Last 7 days </option>
                <option value="15_days"> Last 15 days </option>
                <option value="30_days"> Last 30 days </option>
                <option value="45_days"> Last 45 days </option>
                <option value="60_days"> Last 60 days </option>
                <option value="90_days"> Last 90 days </option>
                <option value="180_days"> Last 180 days </option>
                <option value="365_days"> Last 365 days </option>
                <!--<option value="custom"> Custom Date Range </option>-->
              </select>
              <select class="form-control" style="width:30%; height:auto; padding:8px; margin-right:1%; float:left" onchange="ajaxOrders(this.value);">
                <option value="asc-sdate"> Ship by date (ascending) </option>
                <option value="desc-sdate"> Ship by date (descending) </option>
                <option value="asc-odate"> Order date (ascending) </option>
                <option value="desc-odate"> Order date (descending) </option>
                <option value="asc-status"> Status (ascending) </option>
                <option value="desc-status"> Status (descending) </option>
              </select>
              <select class="form-control" style="width:15%; height:auto; padding:8px; margin-right:1%; float:left" onchange="ajaxOrders(this.value);">
                <option value=""> Show All </option>
                <option value="15-limit"> 15 </option>
                <option value="30-limit"> 30 </option>
                <option value="60-limit"> 60 </option>
                <option value="100-limit"> 100 </option>
              </select>
                {{-- <a class="form-controlSum" style="width:10%; padding:7px; float:left;" href="{{ route('aleshamart_orders') }}">Refresh</a> --}}
            </div>
          </div>
             @if (session()->has('messageType'))
                 <div class="alert alert-{{ session()->get('messageType') }}" role="alert">
                     <strong>STATUS: </strong> {{ session()->get('message') }}
                 </div>
             @endif
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body" style="padding-right:0" id="responsedata">
        <div id="LoadingImageE" style="width:100%; height:auto; text-align:center;display:none;">
         <img src="{{ asset('assets/images/loader7.gif')}}" style="width:60px; height:auto; margin:auto" /></div>
        <div class="table-responsive" style="padding:0">
             @foreach($customerOrders as $product)
                <div class="orderAreas">
                   <div class="orderHeadline">
                     <div class="col-sm-2">
                       <h2>ORDER PLACED</h2>
                       <h3>{{ date('F, d Y',strtotime($product->order_date)) }}</h3>
                     </div>
                     <div class="col-sm-2"><h2>Customer Details</h2></div>
                     <div class="col-sm-2"><h2>Order Details</h2></div>
                     <div class="col-sm-4"><h2>Shipping Details</h2></div>
                     <div class="col-sm-2">
                       <h2>ORDER # {{ $product->ONO }}</h2>
                       <h3><a href="{{ route('orders.orderdetail', [$product->id]) }}">Order Details</a> |
                       <a href="{{ route('orders.invoice', [$product->id,'print']) }}" target="_blank">Invoice</a></h3>
                     </div>
                   </div>
                   <?php
                     $orderAllProducts = \DB::table('order_details AS od')
                   ->leftJoin('products AS p', 'p.id', '=', 'od.product_id')
                   ->select('od.id AS ODID','od.qty','od.status', 'od.subtotal', 'od.created_at','p.name','p.code','p.mainimage','p.product_id_type','p.sku')
                   ->where('od.order_id',$product->id)
                   ->orderBy('od.id', 'desc')->get();

                     $checkExisting = DB::table('shipment_confirms')->where('order_id', $product->id)->first();
                     $getCancelStatus = DB::table('order_cancel_requests')->where('order_id',$product->id)->orderBy('id', 'desc')->first();
                   ?>
                   <div class="displayArea">
                     @if($product->orderStatus != 'Canceled' && $product->orderStatus != 'Delivered' && $product->orderStatus != 'Returned')
                         <div class="col-sm-2 pull-right" style="float:right">
                             @if($product->orderStatus == 'Unshipped')
                                    <div id="selfshipping{{ $product->id }}">
                                            <a href="{{ route('aleshamart_orders.orderdetail', [$product->id]) }}" class="checkoutBtnSum"
                                            style="font-size:13px; padding:5px 2px; color:#000; margin-bottom:3px;">Confirm Shipment</a><br />
                                    </div>

                                    <a href="{{ route('aleshamart_orders.packateslip', [$product->id]) }}" class="cartBtnSum"
                                        style="font-size:13px; padding:5px 2px; color:#000; margin-bottom:3px;" target="_blank" >Print pickup slip</a>
                             @else
                               @if($checkExisting!="")
                                 @if($checkExisting->shipping_method=="Self Shipping")
                                   <a href="javascript:void(0)" class="successBtnSum" onclick="changeStatus('Delivered','{{ $product->id }}')"
                                        style="font-size:11px; padding:2px; margin-bottom:3px; color:#fff;"><i class="fa fa-send"></i> Delivered</a>
                                 @endif
                               @endif
                             @endif

                             @if($getCancelStatus!="" && $getCancelStatus->status =='Cancel')
                               <h6 style="text-align:center; font-size:13px; margin-top:15px; float:left; color:#990000">
                                 {{ $product->fullname }} want to cancel this order
                               </h6>
                             @endif
                               <a href="javascript:void(0)" class="checkoutBtnSum" onclick="orderCancel({{ $product->id }})"
                                style="padding:5px 2px;font-size:13px; color:#000;">Cancel Order</a>
                         </div>
                          <?php $listcolumn = 10; ?>
                     @else
                        <?php $listcolumn = 12; ?>
                     @endif

                     @foreach($orderAllProducts as $orderProducts)
                     <?php
                       $getReturnStatus = \DB::table('order_return_requests')->where('order_details_id',$orderProducts->ODID)->orderBy('id', 'desc')->first();

                       if($orderProducts->status=="Pending"){
                         $backgroundColor = "#999900";
                       }
                       elseif($orderProducts->status=="Dispatched"){
                         $backgroundColor = "#009999";
                       }
                       elseif($orderProducts->status=="Shipped"){
                         $backgroundColor = "#009900";
                       }
                       elseif($orderProducts->status=="Unshipped"){
                         $backgroundColor = "#660000";
                       }
                       elseif($orderProducts->status=="Returned"){
                         $backgroundColor = "#FF9900";
                       }
                       elseif($orderProducts->status=="Canceled"){
                         $backgroundColor = "#FF0000";
                       }
                       else{
                           $backgroundColor = '#000000';
                       }
                     ?>
                       <div class="col-sm-<?php echo $listcolumn; ?> pull-left" style="margin-bottom:40px;">
                        <div class="col-sm-2">
                         @if(isset($orderProducts->mainimage) && $orderProducts->mainimage!="")
                         @php
                          $pro_img_explod = explode('.',$orderProducts->mainimage);
                         @endphp
                         <center><img src="{{ asset('uploads/product/thumnail/jpg/'.$pro_img_explod[0].'.jpg') }}"
                         style="width:80px; height:auto; text-align:center" /></center>@endif</div>
                         <div class="col-sm-2">
                          <span>Buyer Name</span><br /><strong class="blueFont">{{ $product->fullname }}</strong><br />
                            <span>Salse Channel: aleshamart.com</span><br />
                            <span>Billing Country/Region: {{ $product->country }}</span>
                         </div>
                        <div class="col-sm-4">
                          <strong class="blueFont">@if(isset($orderProducts->name) && $orderProducts->name!="") {{ $orderProducts->name }} @endif</strong><br />
                          <span>@if(isset($orderProducts->product_id_type) && $orderProducts->product_id_type!="")
                            {{ $orderProducts->product_id_type }}::</span><strong>{{ $orderProducts->code }} @endif</strong><br />
                            <span>@if(isset($orderProducts->sku) && $orderProducts->sku!="") SKU::</span><strong>{{ $orderProducts->sku }} @endif</strong><br />
                            <span>@if(isset($orderProducts->qty) && $orderProducts->qty!="") Quantity: {{ $orderProducts->qty }} @endif</span><br />
                            <span>@if(isset($orderProducts->subtotal) && $orderProducts->subtotal!="") Item Subtotal: {{ $orderProducts->subtotal }} @endif</span>                                       </div>

                           <div class="col-sm-2">
                             <strong>Standered</strong><br />
                               Ship by date: {{ date('M d, Y', strtotime($product->order_date)) }} <br />
                               Deliver by date: {{ date('M d, Y', strtotime($product->order_date. ' + 3 day')) }}
                               <div style="font-size:13px; padding:3px 5px; font-weight:bold;color:<?php echo  $backgroundColor;?>">{{ $orderProducts->status }} </div>
                           </div>

                           @if($getReturnStatus!="")
                             <div class="col-sm-2 pull-right" style="float:right">
                                   @if($getReturnStatus->status == 'Returned')
                                         <h6>
                                         <center>
                                           Returned: <br /> {{ $getReturnStatus->created_at }}<br />
                                           Return Type: {{ $getReturnStatus->return_type }}<br />
                                           {{ $getReturnStatus->return_causes }}<br />
                                         </center></h6>
                                   @else
                                       <h6 style="text-align:center; font-size:13px; margin-top:15px; float:left; color:#990000">
                                           {{ $product->fullname }} want to return this order
                                       </h6>
                                       <a href="javascript:void(0)" class="checkoutBtnSum" onclick="changeReturn('return','{{ $orderProducts->ODID }}')"
                                       style="width:150px; font-size:13px; padding:2px; margin-bottom:3px; color:#000;"><i class="fa fa-exchange"></i> Return</a>
                                   @endif
                             </div>
                           @endif
                       </div>
                     @endforeach
                   </div>
                </div>
              @endforeach
        </div>
      </div>
    </div>
    <!-- /.card -->
  </section>

  <div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog" style="margin-left:30%;">
 
    </div>
 </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.3.0/dist/sweetalert2.all.js"></script>
<script>
  function hideShow(){
  var thisvalue = document.getElementById('flterhideshow').innerHTML;
  if(thisvalue == 'Hide Filters'){
      $("#flterhideshow").html('Show Filters');
      $("#orderareas").removeClass('col-sm-10');
      $("#orderareas").addClass('col-sm-12');
      $("#filterarea").css('display','none');
  }
  else if(thisvalue == 'Show Filters'){
      $("#flterhideshow").html('Hide Filters');
      $("#orderareas").removeClass('col-sm-12');
      $("#orderareas").addClass('col-sm-10');
      $("#filterarea").css('display','inline');
  }
  }

  function ajaxOrders(key)
  {
  var surl = 'ajaxorder';
  $.ajax({
    type: "GET",
    url: surl,
    data: {'keys':key},
    cache: false,
    beforeSend: function(){
      $('#LoadingImageE').show();
    },
    complete: function(){
      $('#LoadingImageE').hide();
    },
    success: function(response) {
      $('#LoadingImageE').hide();
      $('#responsedata').html(response.viewpages);
      $('#totalOrdersCounts').html(response.totalOCounts);
      var operatorval;
      if(response.operators==0){
        operatorval = 'Today';
      }
      else if(response.operators=='-1'){
        operatorval = 'Last Day';
      }
      else if(response.operators=='all'){
        operatorval = 'All Days';
      }
      else{
        operatorval = 'Last '+response.operators+' Days';
      }
      $('#daysv').html(operatorval);
    },
    error: function (xhr, status) {
      $('#LoadingImageE').hide();
        //alert('Unknown error ' + status);
    }
  });
  }


  function shippingHideShow(thisval,id){
  if(thisval!=''){
    if(thisval=='Self Shipping'){
      document.getElementById("selfshipping"+id).style.display = 'inline';
      document.getElementById("easyshipping"+id).style.display = 'none';
    }
    else if(thisval=='Easy Shipping'){
      document.getElementById("selfshipping"+id).style.display = 'none';
      document.getElementById("easyshipping"+id).style.display = 'inline';
    }
  }
  else{
    document.getElementById("selfshipping"+id).style.display = 'none';
    document.getElementById("easyshipping"+id).style.display = 'none';
  }
  }
  function changeStatus(thisval,id){
  var surl = 'order/changeStatus';
  $.ajax({
    type: "GET",
    url: surl,
    data: {'status':thisval,'order_id':id},
    cache: false,
    beforeSend: function(){
      $('#LoadingImageE').show();
    },
    complete: function(){
      $('#LoadingImageE').hide();
    },
    success: function(response) {
      $('#LoadingImageE').hide();
      window.location.reload();
    },
    error: function (xhr, status) {
      $('#LoadingImageE').hide();
    }
  });
  }

  function orderCancel(oid){
  //alert(type);
  var surl = 'ajaxordercancel';
  $.ajax({
  type: "GET",
  url: surl,
  data: {'order_id':oid},

  cache: false,
  success: function(response) {
    $('.modal-dialog').html(response);
    $('#empModal').modal('show');
  },
  error: function (xhr, status) {
    alert('Unknown error ' + status);
  }
  });
  }
  /*function orderCancel(thisval,id){
  var surl = 'cancelorder';
    swal({
        imageUrl: "{{ asset('assets/images/android-icon-96x96.png') }}",
        title: 'Are you sure?',
        text: "Do you want to cancel this Order ?",
        confirmButtonText: 'Yes Cancel It',
        type: 'warning',
        showCloseButton: true,
          showCancelButton: true,
      }).then((result) => {
        if (result.value) {
        //swal({type: 'success', text: 'You have a bike!'});
          $.ajax({
            type: "GET",
            url: surl,
            data: {'status':thisval,'order_id':id},
            cache: false,
            beforeSend: function(){
              $('#LoadingImageE').show();
            },
            complete: function(){
              $('#LoadingImageE').hide();
            },
            success: function(response) {
              $('#LoadingImageE').hide();
              window.location.reload();
            },
            error: function (xhr, status) {
              $('#LoadingImageE').hide();
            }
          });
        }
        else {
          swal("Safe, Your Order status has been Unchanged!");
        }

    });
  }*/

  function changeProflie(type,oid,ono){
  //alert(type);
  var surl = 'ajaxordercancel';
  $.ajax({
  type: "GET",
  url: surl,
  data: {'actions':type,'order_id':oid,'orderno':ono},

  cache: false,
  success: function(response) {
    //alert(response);
    $('.modal-dialog').html(response);
    $('#empModal').modal('show');
  },
  error: function (xhr, status) {

    alert('Unknown error ' + status);
  }
  });
  }
  function changeReturn(type,oid){
  //alert(type);
  var surl = 'ajaxorderreturn';
  $.ajax({
  type: "GET",
  url: surl,
  data: {'actions':type,'order_details_id':oid},

  cache: false,
  success: function(response) {
    $('.modal-dialog').html(response);
    $('#empModal').modal('show');
  },
  error: function (xhr, status) {
    alert('Unknown error ' + status);
  }
  });
  }
</script>
<script>
  function actionMenu(id){
		//alert(id);
		//$('#actonlists' + id).css('display', 'block');
		$("#actonlists"+id).slideToggle();
	}
</script>
@endsection


