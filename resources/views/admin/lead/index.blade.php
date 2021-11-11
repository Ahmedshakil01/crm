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
            <h3 class="page-title">View Lead List</h3>
        </div>

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active">Lead List</li>
          </ol>
        </div>
        @if($permission->can('news.approval') || $permission->can('news.delete') || $permission->can('news.create'))
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">

          @if($permission->can('news.delete'))
            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','leads');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
          @endif
          @if($permission->can('news.create'))
            <li class=""><a  href="{{ route('lead.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Lead</a></li>
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
        <h3 class="card-title">Total List

          <span class="badge badge-pill badge-secondary">{{ $allleadsource ? count($allleadsource): '' }}</span>
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body p-0">
          <form id="form_check">
            <table class="table" cellspacing="0" width="100%">
              <thead>
                <tr>
                @if($permission->can('news.approval') || $permission->can('news.delete'))
                  <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                @endif
                  <th>Fullname</th>
                  <th>Created at</th>
                @if($permission->can('news.edit') || $permission->can('lead.delete') || $permission->can('lead.detail') )
                  <th width="8%" align="right">Action</th>
                @endif
                </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
              @foreach($allleadsource as $lead)
              <?php $i++;
              if($lead->status!="" && $lead->status==1){
                $statusdis = '<span style="background:#006600;" class="status"><i class="fa fa-check"></i> </span>';
              }
              else{
                $statusdis = '<span style="background:#D91021;"  class="status"><i class="fa fa-times"></i> </span>';
              }

                $leadSource = App\Models\LeadSource::where('id',$lead->source);
                if($leadSource->count() > 0){
                  $sourceinfo = $leadSource->first();
                  $sourcename = $sourceinfo->name;
                }
                else{
                  $sourcename = '';
                }


              ?>

              <tr id="tablerow<?php echo $lead->id;?>" class="tablerow">
                @if($permission->can('news.approval') || $permission->can('lead.delete'))
                <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $lead->id }}" /></td>
               @endif
                <td>
                <div class="row">
                    <div class="col-sm-2"><img src="{{ asset('uploads/leads/file/'.$lead->photo) }}"
                    style="width:100px; height:auto; max-height:100px; border-radius:5px" /></div>
                    <div class="col-sm-10"><h2>{{ $lead->owner_name }}</h2>
                        <span class="ashcolor">Phone:</span> {{ $lead->telephone }}
                        <span class="ashcolor">&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Email:</span> {{ $lead->email }} <span class="ashcolor">&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;Mobile:</span> {{ $lead->contact }}<br />
                        <span class="ashcolor">Acocunt Name:</span> {{ $lead->company }} <span class="ashcolor">&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Lead Source:</span> {{ $sourcename }}
                    </div>
                </div>
                </td>
            	<td>
                	<div class="row">
                    <div class="col-sm-2">
                        @if(isset($lead->getAdmin->photo))
                            <img src="{{ asset('uploads/admin/'.$lead->getAdmin->photo) }}" style="width:30px; height:auto; max-height:30px; border-radius:5px" />
                        @else
                            <img src="{{ asset('assets/backend/admin/dist/img/logo.webp') }}" style="width:30px; height:auto; max-height:30px; border-radius:5px" />
                        @endif
                    </div>
                    <div class="col-sm-10">
                    	{{ $lead->getAdmin->fullname ?? ''}}<br />
                        {{ date('M d, Y H:i A',strtotime($lead->created_at)) }}
                    </div>
                </div>
                </td>
                @if($permission->can('news.edit') || $permission->can('news.delete'))
                <td align="right" class="btn-group">
                  @if($permission->can('news.edit'))
                  <a href="{{route('lead.edit', $lead->id)}}" class="btn btn-sm btn-warning" style="font-size: 12px; float:left; padding:6px 4px; margin-right: 5px;"><i class="fa fa-edit"></i></a>
                  @endif
                  @if($permission->can('news.edit'))
                  <a href="{{ route('admin.lead.details', $lead->id) }}" class="btn btn-sm btn-info" style="font-size: 12px; float:left; padding:6px 10px; margin-right: 5px;"><i class="fa fa-info"></i></a>
                  @endif
                  @if($permission->can('news.delete'))
                    <button type="button" class="btn btn-sm btn-danger" style="font-size: 12px; padding:6px"
                      onclick="deleteSingle('<?php echo $lead->id;?>','masterdelete','leads')"><i class="fa fa-trash"></i></button>
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
