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

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="page-header" style="border:none">
            <h3 class="page-title">View Meeting List</h3>
        </div>
         
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active">Meeting List</li>
          </ol>
        </div>
        @if($permission->can('news.approval') || $permission->can('news.delete') || $permission->can('news.create'))
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">         
          @if($permission->can('news.create'))
            <li class=""><a  href="#" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus"></i> Add meeting</a></li>
          @endif
          </ol>
        </div>
        @endif
      </div>
    </div><!-- /.container-fluid -->
  </section>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          	<form method="POST" action="{{ route('meeting.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Meeting for {{ $type}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="col-sm-12"> 
                        	<div class="form-group row"><label for="name">Meeting Subject</label>
                            <input type="text" name="caption" class="form-control" placeholder="Subject"/></div>  
                            <div class="form-group row"><label for="name">Meeting Date</label>
                            <input type="datetime-local" name="meeting_date" class="form-control"/></div>
                            <div class="form-group row">
                            <label for="name">Description</label>
                            <textarea name="details" class="form-control" placeholder="Description" ></textarea></div>  
                            <div class="form-group row"><label for="name">Meeting Status</label>
                            	<select name="status" class="form-control">
                                	<option value="Not Started">Not Started</option>
                                    <option value="Started">Started</option>
                                    <option value="Postpone">Postpone</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Success">Success</option>
                                    <option value="Decision Pending">Decision Pending</option>
                                </select>
                            </div>                        
                           
                            <div class="form-group row">
                            	 <label for="name">Attachment</label>
                                  <input type="file" class="form-control" name="noticefile"> 
                                  <input type="hidden" name="type" value="{{ $type }}" />
                                  <input type="hidden" name="id" value="{{ $id }}" />
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
                  <th width="21%">{{ ucfirst($type) }} Nme</th>
                  <th width="15%">Subject</th>
                  <th width="30%">Details</th>
                  <th width="30%">Status</th>
                  <th width="11%">Meeting Date</th>
                  <th width="11%">Updated At</th>
                  <th width="10%">Attachment</th>
                @if($permission->can('news.edit') || $permission->can('lead.delete') || $permission->can('lead.detail') )
                  <th width="2%" align="right">Action</th>
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
                
               
                <td>{{ $lead->caption }}</td>
                <td>{{ $lead->details }}</td>
                <td>{{ $lead->status }}</td>
                <td>{{ $lead->meeting_date }}</td>
            	<td>{{ $lead->created_at }}</td>
                <td>{{ $lead->updated_at }}</td> <td>
                 @if($lead->files!="")
                      <a href="{{ route('attachment.samplefiledownload',['file_names'=>$lead->files,'type'=>$type,'path'=>'uploads/meeting']) }}" 
                      style="text-align:center; color:#990000">Download</a>
                  @endif  
                </td>
                
                @if($permission->can('news.edit') || $permission->can('news.delete'))
                <td align="right">   
                  @if($permission->can('news.edit'))
                    <a  href="#" class="btn btn-primary btn-xs" 
                    onclick="meetingModal('{{ $lead->id }}','{{ $lead->caption }}','{{ $lead->details }}','{{ $lead->files }}','{{ $lead->status }}')"><i class="fa fa-edit"></i></a>
                  @endif
                                
                  @if($permission->can('news.delete'))
                    <button type="button" class="btn btn-xs btn-danger" style="margin-top:5px;"
                      onclick="deleteSingle('<?php echo $lead->id;?>','masterdelete','meetings')"><i class="fa fa-trash"></i></button>
                  @endif
                </td>
                @endif
              </tr>
              @endforeach
              </tbody>
            </table>
          </form>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="meetingEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          	<form method="POST" action="{{ route('meeting.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Meeting for {{ $type}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="col-sm-12"> 
                        	<div class="form-group row"><label for="name">Meeting Subject</label>
                            <input type="text" name="caption" class="form-control" placeholder="Caption"  id="subject"/></div>  
                            <div class="form-group row"><label for="name">Meeting Date</label>
                            <input type="datetime-local" name="meeting_date" class="form-control"  id="meeting_date"/></div>
                            <div class="form-group row">
                            <label for="name">Description</label>
                            <textarea name="details" class="form-control" placeholder="Description" id="details"></textarea></div>  
                            <div class="form-group row"><label for="name">Meeting Status</label>
                            	<select name="status" class="form-control" id="status">
                                	<option value="Not Started">Not Started</option>
                                    <option value="Started">Started</option>
                                    <option value="Postpone">Postpone</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Success">Success</option>
                                    <option value="Decision Pending">Decision Pending</option>
                                </select>
                            </div>                   
                            <div class="form-group row">
                            	 <label for="name">Attachment</label>
                                  <input type="file" class="form-control" name="noticefileupdate"> 
                                  <input type="hidden" class="form-control" name="meetingid" id="meetingid">
                                  <input type="hidden" name="type" value="{{ $type }}" />
                                  <input type="hidden" name="id" value="{{ $id }}" />
                                  <input type="hidden" class="form-control" name="stillimg" id="stillimg">
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
@endsection
<script>
	function meetingModal(id,subject,details,stillimg,status){
		$("#meetingEditModal").modal();
		$("#meetingid").val(id);
		$("#subject").val(subject);
		$("#details").val(details);
		$("#stillimg").val(stillimg);
		$("#status").val(status);
	}
</script>