@extends('admin.include.master')
@section('title') Compose Ticket - Aleshamart @endsection

@section('content')

<?php
  $permission = Auth::guard('administration')->user();
?>
<style>
	.accountInput{
		width:100%;
		margin:5px;
		float:left;
	}
	.accountInput label{
		font-size:20px;
		color:#000;
		font-weight:bold;
	}
	.accountInput input{
		border:1px solid #ccc;
	}
	.accountInput textarea{
		border:1px solid #ccc;
		min-height:200px;
	}
	.composmail{
		width:100%;
		height:auto;
		float:left;
		margin:20px;
		border-top-left-radius:7px;
		border-top-right-radius:7px;
		border:1px solid #ccc;
	}
	.composmail .titles{
		width:100%;
		height:auto;
		float:left;
		background:#202124;
		padding:10px;
		color:#fff;
		border-top-left-radius:7px;
		border-top-right-radius:7px;
	}
	
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
    .cartBtnSumUp{
	background: #1f3f9b;
    background: -webkit-linear-gradient(top,#aac6de,#1f3f9b);
    background: linear-gradient(to bottom,#aac6de,#1f3f9b);
	box-shadow: 0 1px 0 rgba(255,255,255,.4) inset;
	display: block;
    position: relative;
    overflow: hidden;
    height: auto;
    border-radius: 5px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:13px;
	float:left;
	width:100%;
	padding:5px 0;
	cursor:pointer;
	border:1px solid #999;
	color:#fff;
	text-align:center;
}
    
</style>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>
    function getTomailData(name,id){		
        $("#getrecipients").html(name);
        $("#tomail").val(id);
    }

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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="content-wrapper" ng-app="appTable" ng-controller='ItemsController'>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="page-header" style="border:none">
                <h3 class="page-title">Compose Ticket</h3>
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
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">New Ticket</li>
                </ol>
            </div>
        @if($permission->can('support.inbox') || $permission->can('support.draftmail') || $permission->can('support.sentmail'))
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
            @if($permission->can('support.inbox'))
              <li class=""><a  href="{{ route('admin.mailbox') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Inbox</a></li>
            @endif
            @if($permission->can('support.draftmail'))
              <li class=""><a  href="{{ route('admin.draftmail') }}" style="color: #fff; margin-right:20px" class="btn btn-warning btn-sm"><i class="fa fa-list"></i> Draft Ticket</a></li>
            @endif
            @if($permission->can('support.sentmail'))
              <li class=""><a  href="{{ route('admin.sentmail') }}" style="color: #fff; margin-right:20px" class="btn btn-success btn-sm"><i class="fa fa-list"></i> Sent Ticket</a></li>
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
            <h3 class="card-title">Create</h3>
    
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          {{-- <div class="card-body p-0" style="margin-top: 30px;margin-bottom: 30px;"> --}}
            <div class="col-sm-12">	 
                <div class="col-sm-8 col-sm-offset-2" style="margin-bottom:20px;">
                    <form method="POST" action="{{ route('admin.newmailaction') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="composmail">
                            @if (\Session::has('successmessage'))
                                <div class="alert alert-success">
                                    <h2>{!! \Session::get('successmessage') !!}</h2>
                                </div>
                            @endif
                            <div class="titles">New Message</div>                               
                                <div style="border:none; border-bottom:1px solid #ccc; z-index:9999999; width:100%; float:left">                            
                                <div  style="width:100%; float:left"><input type="text" class="form-control" id="recipients" placeholder="Recipients" name="tomailname" 
                                style="border:none"></div>
                                <div  style="width:48%; float:left; margin:5px; text-align:right; font-weight:bold" id="getrecipients"></div>
                                <input type="hidden" name="tomail" id="tomail" />
                            </div>
                            <div>
                                <input type="text" class="form-control" placeholder="Subject" name="subject" style="border:none; padding:20px; border-bottom:1px solid #ccc">
                            </div>
                            <div style="width:100%;">
                            <textarea class="form-control ckeditor" placeholder="Message" name="message" 
                            style="border:none;  float:left; width:100%; height:200px;"></textarea>
                            </div>  
                            <div style="width:100%; height:auto; margin-top:10px; border:0">
                                <select name="mailtype" class="form-control">
                                    <option value="open">Open</option>
                                    <option value="processing">Processing</option>
                                    <option value="resolved">Resolved</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>  
                                                        
                        </div>   
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <a href="javascript:void();" style="margin-left:20px; float:right; margin-bottom:10px; text-align:right" 
                            ng-click="addItem()" class="btn btn-success btn-xs">Add More <i class="fa fa-plus"></i></a>
                            </div>    
                            <div class="col-sm-10">                                    
                                <div ng-repeat="item in items" ng-model="newItemName">
                                    <div class="col-sm-3">
                                        <div style="width:150px; float:left;">
                                            <input id="file-upload" name='mailattach[]' type="file" style="width:150px;">  
                                            <a ng-click="deleteItem($index)" class="btn btn-danger btn-xs" title="Remove This Row">
                                                <i class="fa fa-minus"></i></a>                                                
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-1"><a ng-click="deleteItem($index)" class="btn btn-danger btn-sm" title="Remove This Row">
                                    <i class="fa fa-minus"></i></a></div>                                         --}}
                                </div>
                            </div>
                        </div>               
                        <div style="margin:15px; width:100%; float:left">
                            <div style=" width:10%; float:left; margin-right:10px;"><input type="submit" name="send" value="Send" class="successBtnSum" /></div>
                            <div style=" width:10%; float:left"><input type="submit" name="draft" value="Draft" class="cartBtnSumUp" /></div>  
                        </div>        
                                                    
                    </form>
                </div>
            </div>
          {{-- </div> --}}
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    
    </section>
</div>
{{-- ///////////////////////// --}}


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <style>
    	.twitter-typeahead{
			width:100%; !important;
		}
		.tt-menu{
			top:35px !important;
		}
    </style>
<script>
        jQuery(document).ready(function($) {
            // Set the Options for "Bloodhound" suggestion engine
            var engine = new Bloodhound({
                remote: {
                    url: 'getautosellers?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('tomailname'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $("#recipients").typeahead({
                hint: true,
                highlight: true,
                minLength: 0
            }, {
               // source: engine.ttAdapter(),

                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'usersList',
				display: 'value',
			    source: engine.ttAdapter(),

                // the key from the array we want to display here (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown">'
                    ],
					
                    suggestion: function (data) {
                        console.log(data);
						var cname = "'"+data.email + ' - ' + data.name+"'";
						var custid = "'"+data.id+"'";
                        return '<a href="javascript:void(0)" onclick="getTomailData('+cname+','+custid+')" class="list-group-item" style="color:#333">' + data.email + ' - ' + data.name + '</a>'
              }
                }
            });
        });
		
</script>
@endsection

