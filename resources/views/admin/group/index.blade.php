@extends('admin.include.master')
	@section('title') Group List - aleshamart @endsection
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
            <h3 class="page-title">View Group List</h3>
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
            <li class="breadcrumb-item active">Group List</li>
          </ol>
        </div>
        @if($permission->can('group.approval') || $permission->can('group.delete') || $permission->can('group.create'))
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            @if($permission->can('group.approval'))
{{--            <li class=""><a  href="javascript:void(0)" onclick="permissions('groups','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>--}}
{{--            <li class=""><a  href="javascript:void(0)" onclick="permissions('groups','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>--}}
            @endif
            @if($permission->can('group.delete'))
            <li class=""><a  href="javascript:void(0)" onclick="deletedata('masterdelete','groups');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
            @endif
            @if($permission->can('group.create'))
            <li class=""><a  href="{{ route('group.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Group</a></li>
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
          <span class="badge badge-pill badge-secondary">{{ count($allgroup) }}</span>
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
                    @if($permission->can('group.approval') || $permission->can('group.delete'))
                      <th width="1%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                    @endif
                      <th width="35%">Name </th>
                      <th width="11%">Created At</th>
                    @if($permission->can('group.edit') || $permission->can('group.delete'))
                      <th width="5%" align="right">Action</th>
                    @endif
                  </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                @foreach($allgroup as $group)
                <tr id="tablerow<?php echo $group->id;?>" class="tablerow">
                  @if($permission->can('group.approval') || $permission->can('group.delete'))
                  <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $group->id }}" /></td>
                  @endif
                  {{-- <td align="center" valign="top"><input type="checkbox"  name="summe_code[]" id="summe_code<?php //echo $i; ?>" value="{{ $news->id }}" /></td> --}}
                  <td align="center" valign="top">{{ $group->name }}</td>
                  <td align="center" valign="top">{{ $group->created_at }}</td>
                  @if($permission->can('group.edit') || $permission->can('group.delete'))
                  <td align="center" valign="top">
                    @if($permission->can('group.edit'))
                      <div style="width:50%; float:left">
                        <a href="{{ route('group.edit', $group->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px">
                          <i class="fa fa-edit"></i>
                        </a>
                      </div>
                    @endif
                    @if($permission->can('group.delete'))
                      <div style="width:50%; float:left">
                        <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                        onclick="deleteSingle('<?php echo $group->id;?>','masterdelete','groups')"><i class="fa fa-trash"></i></button>
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
