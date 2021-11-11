
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
		width:100%;
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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>
function getTomailData(status){		
	if(status=='inline'){
		document.getElementById('replyarea').style.display = status;		
		window.scrollTo(0,document.body.scrollHeight);
	}
	else if(status=='none'){
		document.getElementById('replyarea').style.display = status;
		document.getElementById('replyfield').value = '';
	}
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

{{-- @section('content') --}}
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <div id="content-wrapper" ng-app="appTable" ng-controller='ItemsController'>
      <div class="container-fluid">
      		<div class="card mb-3">
			<div class="row" style="background:#FFFFFF">
                    <div class="col-sm-12">	 
                    	@if (\Session::has('successmessage'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('successmessage') !!}</li>
                            </ul>
                        </div>
                    @endif
                   
                   <div class="col-sm-2" style="margin-bottom:20px;">
                   		<div style="width:100%; height:auto; margin-top:60px; float:left">
                           <div style="width:100%; float:left; height:auto">
                            	<a href="{{ route('seller.newmail') }}" class="composebtn"><img src="{{ asset('assets/images/create_32dp.png') }}" />Compose Mail</a>
                            </div>
                           <div class="detailsleftmenu">                           
                                <ul>
                                    <li><a href="{{ route('customer.mailbox') }}"><i class="fa fa-bars"></i> Inbox</a></li>
                                    <li><a href="{{ route('seller.sentmail') }}"><i class="fa fa-bars"></i> Sent Mail</a></li>
                                    <li><a href="{{ route('seller.draftmail') }}"><i class="fa fa-bars"></i> Draft Mail</a></li>
                                </ul>
                            </div>
                        </div>
                   </div>
                   
                   <?php $admininfo = App\Models\Administration::find($allmails->userid);
					if($admininfo!=""){
						$adminname = $admininfo->fullname;
						$adminmail = $admininfo->designation;
						$adminphoto = 'uploads/admin/'.$admininfo->photo;
					}
					else{
						$adminname = '';
						$adminmail = '';
						$adminphoto = 'assets/images/default.jpg';
					}
				  ?>				  
                  		<div class="col-sm-10" style="margin-bottom:20px;">
                           <div class="composmail">                      
                                   <h2 class="subject">{{ $allmails->subject }}</h2>
                                   <div style="border:none; margin-bottom:15px; width:100%; float:left">                            
                                      <div style="width:6%; float:left">
                                      	<img src="{{ asset($adminphoto ) }}" style="width:40px;  height:40px; border-radius:50%; border:1px solid #ccc; padding:2px" />
                                      </div>
                                      <div style="width:74%; float:left">
                                      	<h2 class="fromname">{{ $adminname }}</h2>
                                        <h3 class="fromdesignation">{{ $adminmail }}</h3>
                                      </div>
                                      <div style="width:20%; float:left">
                                      	<h3 class="fromdesignation" style="width:70%; float:left">{{ $allmails->created_at }}</h3>
                                        <a href="javascript:void()" class="replyicon" onclick="getTomailData('inline')">
                                        <i class="fa fa-reply" aria-hidden="true"></i></a>
                                      </div>                                      
                                   </div>
                                  
                                	<div class="details">
                                      {!! $allmails->description !!}
                                   </div>
                                   @if ($allmails->ticket_status=="close")
                                        <p class="btn btn-warning">Ticket is Closed</p>
                                    @else
                                    <a href="javascript:void()" class="replybtn" onclick="getTomailData('inline')">
                                        <i class="fa fa-reply" aria-hidden="true"></i> Reply</a>
                                    @endif
                           		</div> 
                                 
                              <div class="replyarea" id="replyarea">                      
                                  <div style="width:6%; float:left">
                                    <img src="{{ asset($adminphoto ) }}" style="width:40px;  height:40px; border-radius:50%; border:1px solid #ccc; padding:2px" />
                                  </div>
                                  <div style="width:94%; float:left">
                                  	<form method="POST" action="{{ route('seller.mailreply') }}" enctype="multipart/form-data">
                         			@csrf
                                     	<div class="replyboxes">
                                         <a href="#" style="width:3%; float:left;color:#999; text-align:left; margin-top:5px;"><i class="fa fa-reply" aria-hidden="true"></i></a>
                                         <h3 class="fromdesignation" style="width:97%; float:left">{{ $adminname.' ('. $adminmail.' )' }} 
                                         <input type="hidden" value="{{ $allmails->userid }}" name="tomail" />                                         
                                         	<input type="hidden" value="{{ $allmails->id }}" name="mailid" /></h3>
                                         <textarea name="replymsg" id="replyfield"></textarea>                                         
                                                       
                                        <div style="margin:15px; width:100%; float:left">
                                           <div class="col-sm-1" style="padding:0; margin:0">
                                           		<input type="submit" name="send" value="Send" 
                                                style="background-color:#2874f0;color:#fff;padding:7px 15px; border:none; 
                                                border-radius:5px; box-shadow:0 0 1px 1px #0b5bc4;box-sizing: border-box; " />
                                           </div>
                                                
                                            <div class="col-sm-10">                                    
                                                <div ng-repeat="item in items" ng-model="newItemName">
                                                    <div class="col-sm-2">
                                                      <div style="width:150px; float:left;">
                                                          <input id="file-upload" name='mailattach[]' type="file" style="width:150px;">                                                  
                                                      </div>
                                                   </div>
                                                    <div class="col-md-1"><a ng-click="deleteItem($index)" class="btn btn-danger btn-sm" style="color:#fff" title="Remove This Row">
                                                    <i class="fa fa-minus"></i></a></div>                                        
                                                </div>
                                            </div>
                                            <div class="col-sm-1" style="padding:0; margin:0">
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
                </div>
             </div>
        </div>
     </div>
{{-- @endsection --}}

