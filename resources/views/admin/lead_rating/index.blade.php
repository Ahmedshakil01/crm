@extends('admin.include.master')
	@section('title') Article List - aleshamart @endsection
@section('content')

<?php
  $permission = Auth::guard('administration')->user();
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="page-header" style="border:none">
            <h3 class="page-title">View Rating List</h3>
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
            <li class="breadcrumb-item active">Rating List</li>
          </ol>
        </div>
        @if($permission->can('lead_rating.approval') || $permission->can('lead_rating.delete') || $permission->can('lead_rating.create'))
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
          @if($permission->can('lead_rating.approval'))
            <li class=""><a  href="javascript:void()" onclick="permissions('lead_rating','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
            <li class=""><a  href="javascript:void()" onclick="permissions('lead_rating','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
          @endif
          @if($permission->can('lead_rating.delete'))
            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','lead_rating');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
          @endif
          @if($permission->can('lead_rating.create'))
            <li class=""><a  href="{{ route('lead_rating.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Post</a></li>
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
          <span class="badge badge-pill badge-secondary">{{ count($allleadsource) }}</span>
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
            <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                  <tr>
                    @if($permission->can('news.approval') || $permission->can('news.delete'))
                    <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                    @endif
                    <th width="27%">Name </th>
                      <th width="32%">Details </th>
                    <th width="16%">Status</th>
                    @if($permission->can('news.edit') || $permission->can('news.delete'))
                    <th width="23%" align="right">Action</th>
                    @endif
                  </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                @foreach($allleadsource as $lead_rating)
                <?php $i++;
                ?>

                <tr id="tablerow<?php echo $lead_rating->id;?>" class="tablerow">
                @if($permission->can('news.approval') || $permission->can('news.delete'))
                  <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $lead_rating->id }}" /></td>
                @endif
                  <td align="center" valign="top">{{ $lead_rating->name }}</td>
                  <td align="center" valign="top">{!! $lead_rating->details !!}</td>
                  <td align="center" valign="top">{{ $lead_rating->status }}</td>
                  @if($permission->can('news.edit') || $permission->can('news.delete'))
                  <td align="center" valign="top">
                    @if($permission->can('news.edit'))
                    <div style="width:30%; float:left">
                      <a href="{{ route('lead_rating.edit', $lead_rating->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i>Edit</a>
                    </div>
                    @endif
                    @if($permission->can('news.delete'))
                    <div style="width:30%; float:left">
                      <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px" onclick="deleteSingle('<?php echo $lead_rating->id;?>','masterdelete','lead_rating')">
                      <i class="fa fa-trash"></i>Delete</button>
                    </div>
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
