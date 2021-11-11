@extends('admin.include.master')
@section('title') Ticket Details - Aleshamart @endsection
<?php
$permission = Auth::guard('administration')->user();
?>
<style>
	.composmail{
		width:100%;
		height:auto;
		float:left;
		margin:20px;
	}
	.composmail .subject{
		width:100%;
		height:auto;
		float:left;
		padding:10px;
		color:#000;
		padding:0;
		margin:0 0 30px 60px;
		font-weight:normal;
	}
	.composmail .details{
		width:100%;
		height:auto;
		float:left;
		padding:10px;
		color:#000;
		padding:0;
		margin:0 0 30px 60px;
		font-weight:normal;
	}
	.fromname{
		 -webkit-font-smoothing: antialiased;
		font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
		font-size: 14px;
		letter-spacing: .2px;
		color: #000;
		line-height: 20px;
		font-weight:bold;
		padding:0;
		margin:0;
	}
	.fromdesignation{
		 -webkit-font-smoothing: antialiased;
		font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
		font-size: 13px;
		letter-spacing: .2px;
		color: #666;
		line-height: 20px;
		font-weight:normal;
		padding:0;
		margin:0;
		text-transform:capitalize;
	}
	.replyarea{
		width:100%;
		height:auto;
		float:left;
		margin:20px;
		border-radius:10px;
		display:none;
	}
	.replyboxes{
		width:95%;
		height:auto;
		float:left;
		box-shadow: 0 0 3px 3px #eaeaea;
		border-radius:10px;
		padding:10px;
	}
	.replyboxes textarea{
		width:100%;
		height:auto;
		border:none;
		background:transparent;
		min-height:150px;
		color:#000;
	}
	textarea:hover,
	input:hover,
	textarea:active,
	input:active,
	textarea:focus,
	input:focus
	{
		outline: 0px !important;
		border: none!important;
	}
	.replyicon{
		width:30%; float:left;color:#999; text-align:left; margin-top:5px;
	}
	.replyicon:hover{
		color:#000;
	}

	.replybtn{
		width:auto; color:#999; text-align:left; border:1px solid #ccc; padding:8px 25px;margin:0 0 30px 60px;
		font-size:14px;
		text-decoration:none;
		border-radius:5px;
	}
	.replybtn:hover{
		color:#000;
		border:1px solid #000;
		text-decoration:none;
		background:#eaeaea;
	}

	.composebtn{
		width:auto;
		box-shadow: 0 1px 2px 0 rgba(60,64,67,0.302), 0 1px 3px 1px rgba(60,64,67,0.149);
		-webkit-font-smoothing: antialiased;
		font-family: 'Google Sans', Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
		font-size: 14px;
		letter-spacing: .25px;
		-webkit-align-items: center;
		align-items: center;
		background-color: #fff;
		background-image: none;
		-webkit-border-radius: 24px;
		border-radius: 24px;
		color: #3c4043;
		display: -webkit-inline-box;
		display: -webkit-inline-flex;
		display: inline-flex;
		font-weight: 500;
		height: 48px;
		min-width: 56px;
		overflow: hidden;
		padding: 0 24px 0 0;
		text-transform: none;
		text-align:center;
		font-weight:bold;
		padding-left:10px;
	}
	.detailsleftmenu{
		width:100%;
		height:auto;
		float:left;
		margin:10px 20px;
	}

	.detailsleftmenu ul{
		width:100%;
		height:auto;
		float:left;
		margin:0;
		padding:0;
		display:block;
	}
	.detailsleftmenu ul li{
		width:100%;
		height:auto;
		float:left;
		display:inline;
	}
	.detailsleftmenu ul li a{
		width:100%;
		height:auto;
		float:left;
		margin:0;
		padding:6px 10px;
		display:inline;
		color:#666;
		font-size:16px;
	}
	.detailsleftmenu ul li a:hover{
		width:100%;
		height:auto;
		float:left;
		margin:0;
		padding:6px 10px;
		display:inline;
		color:#666;
		font-size:16px;
		text-decoration:none;
		background:#FFCACA;
		border-radius:22px;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>

	function scrollSmoothToBottom (id) {
		$(document).ready(function(){
			//alert('df');
			// var div = document.getElementById(id);
			var div = $("#"+id);
		$('#' + id).animate({
			scrollTop: div.scrollHeight - div.clientHeight
		}, 500);
			});

	}

	//Require jQuery
	function scrollSmoothToTop (id) {
	var div = document.getElementById(id);
	$('#' + id).animate({
		scrollTop: 0
	}, 500);
	}

	function getTomailData(status){
		if(status=='inline'){
			document.getElementById('replyarea').style.display = status;
			//window.scrollTo(100,document.body.scrollHeight);
		}
		else if(status=='none'){
			document.getElementById('replyarea').style.display = status;
			document.getElementById('replyfield').value = '';
		}
	}


	// function getTomailData(name,id){
    //     $("#getrecipients").html(name);
    //     $("#tomail").val(id);
    // }

    // var app = angular.module("appTable",[]);
    // app.controller("ItemsController",function($scope) {
    // $scope.items = [{newItemName:''}];
    //     $scope.addItem = function (index) {
    //         $scope.items.push({newItemName:''});
    //     }
    //     var newDataList = [];
    //     $scope.deleteItem = function (index) {
    //         if(!index){
    //             alert("\tDelete Error. \n Root Row not deletable.");
    //             $scope.items.push({newItemName:''});
    //         }
    //         $scope.items.splice(index, 1);
    //     }
    // });

	var app = angular.module("appTable",[]);
	app.controller("ItemsController",function($scope) {
	$scope.items = [{newItemName:''}];
		$scope.addItem = function (index) {
			$scope.items.push({newItemName:''});
		}
		var newDataList = [];
		$scope.deleteItem = function (index) {
			if(!index){
				alert("\tDelete Error. \n Root Row not deletable.");
				$scope.items.push({newItemName:''});
			}
			$scope.items.splice(index, 1);
		}
	});
</script>



@section('content')

<div class="content-wrapper" ng-app="appTable" ng-controller="ItemsController">
	<section class="content-header">
	  <div class="container-fluid">
		<div class="row mb-2">
		  <div class="col-sm-6">
			<div class="page-header" style="border:none">
			  <h3 class="page-title">Ticket Details</h3>
		  </div>
			{{-- @if (session()->has('messageType'))
				<div class="alert alert-{{ session()->get('messageType') }}" role="alert">
					<strong>STATUS: </strong> {{ session()->get('message') }}
				</div>
			@endif --}}
			@if (\Session::has('successmessage'))
				<div class="alert alert-success">
					<ul>
						<li>{!! \Session::get('successmessage') !!}</li>
					</ul>
				</div>
			@endif
			<?php
              $sellerinfo = App\Models\Customer::where('id', $allmails->tomail)->first();
              $admininfo = App\Models\Administration::where('id', $allmails->userid)->first();
			  var_dump($admininfo);
              //dd($sellerinfo);
				if($admininfo!=""){
					$adminname = $admininfo->fullname;
					$adminmail = $admininfo->designation;
					$adminphoto = 'assets/backend/admin/uploads/admin/'.$admininfo->photo;
				}
				else{
					$adminname = '';
					$adminmail = '';
					$adminphoto = 'assets/backend/admin/uploads/admin/default.png';
				}
			?>
		  </div>
		  <div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
			  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
			  <li class="breadcrumb-item">Settings</li>
			  <li class="breadcrumb-item active">Ticket Details</li>
			</ol>
		  </div>
		  @if($permission->can('support.compose') || $permission->can('support.draftmail') || $permission->can('support.inbox'))
		  <div class="col-sm-12">
			<ol class="breadcrumb float-sm-right">
			@if($permission->can('support.compose'))
				<li class=""><a  href="{{ route('admin.newmail') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Compose Ticket</a></li>
			@endif
			@if($permission->can('support.draftmail'))
				<li class=""><a  href="{{ route('admin.draftmail') }}" style="color:#fff; margin-right:20px" class="btn btn-warning btn-sm"><i class="fa fa-list"></i> Draft Ticket</a></li>
			@endif
			@if($permission->can('support.inbox'))
				<li class=""><a  href="{{ route('admin.mailbox') }}" style="color:#fff; margin-right:20px" class="btn btn-success btn-sm"><i class="fa fa-list"></i> Inbox Ticket</a></li>
			@endif
			</ol>
		  </div>
		  @endif
		</div>
	  </div><!-- /.container-fluid -->
	</section>

	<section class="content">

	  <!-- Default box -->
	  <div class="card">
		<div class="card-header">
		  {{-- <h3 class="card-title">
			<span class="badge badge-pill badge-secondary"></span>
		  </h3> --}}

		  <div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
			  <i class="fas fa-minus"></i></button>
			<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
			  <i class="fas fa-times"></i></button>
		  </div>
		</div>
		<div class="card-body p-0">
			<div class="col-sm-12" style="margin-bottom:20px; background:#fff">
				<div class="composmail">
					<h2 class="subject">Subject: {{ $allmails->subject }}</h2>
					<div style="border:none; margin-bottom:15px; width:100%; float:left">
						<div style="width:6%; float:left">
							@if ($sellerinfo->photo)
							<img src="{{ asset('uploads/merchant/'.$sellerinfo->photo ) }}" style="width:40px;  height:40px; border-radius:50%; border:1px solid #ccc; padding:2px" />
							@endif
						</div>
						<div style="width:74%; float:left">
							<h2 class="fromname">{{ $adminname }}</h2>
                            @if($admininfo!="")
                                <h3 class="fromdesignation">To: {{ $admininfo->email }}</h3>
                            @endif
                            @if($sellerinfo!="")
							<h3 class="fromdesignation">From: {{ $sellerinfo->email }}</h3>
                            @endif
						</div>
						<div style="width:20%; float:left">
							<h3 class="fromdesignation" style="width:70%; float:left">{{ $allmails->created_at }}</h3>
							<a href="javascript:void()" class="replyicon" onclick="getTomailData('inline'); scrollSmoothToBottom('replyarea')">
							<i class="fa fa-reply" aria-hidden="true"></i></a>
						</div>
					</div>

					<div class="details">
						{!! $allmails->description !!}
					</div>
				
						
					<a href="javascript:void()" class="replybtn" onclick="getTomailData('inline')">
					<i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
					
				</div>
		
				<div class="replyarea" id="replyarea">
					<div style="width:6%; float:left">
						{{-- <img src="{{ asset('uploads/admin/'.$admininfo->photo ) }}" style="width:40px;  height:40px; border-radius:50%; border:1px solid #ccc; padding:2px" /> --}}
					</div>
					<div style="width:94%; float:left">
						<form method="POST" action="{{ route('admin.mailreply') }}" enctype="multipart/form-data">
						@csrf
							<div class="replyboxes">
							<a href="#" style="width:3%; float:left;color:#999; text-align:left; margin-top:5px;"><i class="fa fa-reply" aria-hidden="true"></i></a>
							<h3 class="fromdesignation" style="width:97%; float:left">{{ $admininfo->fullname.' ('. $admininfo->designation.' )' }}
								<input type="hidden" value="{{ $admininfo->id }}" name="tomail" />
								<input type="hidden" value="{{ $allmails->id }}" name="mailid" />
							</h3>
							<textarea name="replymsg" id="replyfield" style="border: 1px solid #ddd;"></textarea>
									<div class="form-group mt-5">
										@php
											$enumValues=['open', 'processing', 'resolved', 'closed']
										@endphp
										<label for="updateStatus">Ticket Status</label>
										<select name="mailtype" class="form-control">
											@foreach ($enumValues as $enumValue)
												<option value="{{$enumValue}}" @if ($enumValue== $allmails->mailtype){{"selected"}} @endif>{{ucfirst($enumValue)}}</option>
											@endforeach
									
										</select>
									</div>
								<div style="margin:15px; width:100%; float:left">
									<div class="col-sm-1" style="padding:0; margin-bottom: 15px">
										<input type="submit" name="send" value="Send"
										style="background-color:#2874f0;color:#fff;padding:7px 15px; border:none;
										border-radius:5px; box-shadow:0 0 1px 1px #0b5bc4;box-sizing: border-box; " />
									</div>

									<div class="col-sm-4" style="float:left">
										<div ng-repeat="item in items" ng-model="newItemName">
											<div class="col-sm-2">
											<div style="width:150px; float:left;">
												<input id="file-upload" name='mailattach[]' type="file" style="width:150px;">
											</div>
										</div>
											<div class="col-md-1"><a ng-click="deleteItem($index)" class="btn btn-danger btn-sm" style="color:#fff; margin-top: 5px;" title="Remove This Row">
											<i class="fa fa-minus"></i></a></div>
										</div>
									</div>
									<div class="col-sm-1" style="padding:0; margin:0; float:left;">
										<a href="javascript:void();" ng-click="addItem()" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
										<a href="javascript:void();" style="color:#999; margin:5px 0 0 5px; font-size:18px;" onclick="getTomailData('none')"><i class="fa fa-trash"></i></a>
									</div>
								
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /.card-body -->
	  </div>
	  <!-- /.card -->

	</section>
</div>

@endsection

