 @extends('admin.include.master')
	@section('title') Customer List - Aleshamart @endsection
@section('content')

<?php
  $permission = Auth::guard('administration')->user();
?>

<style>
	.payments{
		padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:15px;text-align:center; font-weight:bold;
	}
	.status{
		background:#006600; padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:12px;text-align:center
	}
</style>

<div class="content-wrapper" ng-app="appTable" ng-controller='ItemsController'>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="page-header" style="border:none">
            <h3 class="page-title">View Attachment List</h3>
        </div>
         
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active">Attachment List</li>
          </ol>
        </div>
        @if($permission->can('news.approval') || $permission->can('news.delete') || $permission->can('news.create'))
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">         
          @if($permission->can('news.create'))
            <li class=""><a  href="#" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus"></i> Add attachment</a></li>
          @endif
          </ol>
        </div>
        @endif
      </div>
    </div><!-- /.container-fluid -->
  </section>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          	<form method="POST" action="{{ route('attachment.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attachment for {{ $type}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                        <div class="col-sm-12">
                        <a href="javascript:void();" style="margin-left:20px; float:right; margin-bottom:10px; text-align:right" 
                        ng-click="addItem()" class="btn btn-success btn-sm">Add More <i class="fa fa-plus"></i></a></div>
                        
                        <div ng-repeat="item in items" ng-model="newItemName">
                              <label for="name">Select file</label>
                              <div class="row">
                              	<div class="col-md-5">
                                      <input type="file" class="form-control" name="noticefile[]"> 
                                      <input type="hidden" name="type" value="{{ $type }}" />
                                      <input type="hidden" name="id" value="{{ $id }}" />
                                </div>
                                <div class="col-md-6"><input type="text" name="caption[]" class="form-control" placeholder="Caption" /></div>
                                <div class="col-md-1"><a ng-click="deleteItem($index)" class="btn btn-danger btn-sm" title="Remove This Row">
                                <i class="fa fa-minus"></i></a></div>
                            </div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
            </form>
          </div>
        </div>
        
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Total List
          
          <span class="badge badge-pill badge-secondary">{{ $allleadsource ? count($allleadsource): '' }}</span>
        </h3>

        
      </div>
      <div class="card-body p-0">
          <form id="form_check">
            <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                @if($permission->can('news.approval') || $permission->can('news.delete'))
                  <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                @endif
                  <th width="10%">{{ ucfirst($type) }} Nme</th>
                  <th width="10%">Attachment</th>
                  <th width="10%">Caption</th>
                  <th width="10%">Entry Date</th>
                  <th width="10%">Updated At</th>
                @if($permission->can('news.edit') || $permission->can('lead.delete') || $permission->can('lead.detail') )
                  <th width="8%" align="right">Action</th>
                @endif
                </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
              @foreach($allleadsource as $lead)
              <?php $i++;
			  
			  if($type=='lead'){
			  	$leads = App\Models\Lead::where('id',$lead->lead_id)->first();
			  }
			  else{
			  	$leads = App\Models\Contact::where('id',$lead->lead_id)->first();
			  }
                
                if($leads!=""){
                  $leadsname = '<h5 style="padding:0; margin:0">'.$leads->owner_name.'</h5><span class="ashcolor">Account:</span> '.$leads->company;
                }
                else{
                  $leadsname = '';
                }
              ?>

              <tr id="tablerow<?php echo $lead->id;?>" class="tablerow">
                @if($permission->can('news.approval') || $permission->can('lead.delete'))
                <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $lead->id }}" /></td>
               @endif
                <td>{!! $leadsname !!}</td>
                
                <td>
                 @if($lead->files!="")
                      <a href="{{ route('attachment.samplefiledownload',['file_names'=>$lead->files,'type'=>$type,'path'=>'uploads/attachment/'.$type]) }}" 
                      style="text-align:center; color:#990000">Download</a>
                  @endif  
                </td>
                <td>{{ $lead->caption }}</td>
            	<td>{{ $lead->created_at }}</td>
                <td>{{ $lead->updated_at }}</td>
                
                @if($permission->can('news.edit') || $permission->can('news.delete'))
                <td align="right" class="btn-group">                 
                  @if($permission->can('news.delete'))
                    <button type="button" class="btn btn-sm btn-danger" style="font-size: 12px; padding:6px"
                      onclick="deleteSingle('<?php echo $lead->id;?>','masterdelete','attachments')"><i class="fa fa-trash"></i></button>
                  @endif
                </td>
                @endif
              </tr>
              @endforeach
              </tbody>
            </table>
          </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
</div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>
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