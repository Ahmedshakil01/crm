@extends('admin.include.master')
@section('title') Permission List - Aleshamart @endsection
@section('content')

<?php
    $rolePermission = Auth::guard('administration')->user();
?>

<div class="content-wrapper">
<section class="content-header">
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <div class="page-header" style="border:none">
        <h3 class="page-title">View Permission List</h3>
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
        <li class="breadcrumb-item active">Permission List</li>
      </ol>
    </div>
    @if($rolePermission->can('permission.approval') || $rolePermission->can('permission.delete') || $rolePermission->can('permission.create'))
    <div class="col-sm-12">
      <ol class="breadcrumb float-sm-right">
        @if($rolePermission->can('permission.approval'))
        {{-- <li class=""><a  href="javascript:void()" onclick="permissions('permissions','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li> --}}
        {{-- <li class=""><a  href="javascript:void()" onclick="permissions('permissions','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li> --}}
        @endif
        @if($rolePermission->can('permission.delete'))
        {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','permissions');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
        @endif
        @if($rolePermission->can('permission.create'))
        <li class=""><a  href="{{ route('permission.create') }}" style="color:#fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Create New Permission</a></li>
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
      <span class="badge badge-pill badge-secondary">{{ count($permissions) }}</span>
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
                  @if($rolePermission->can('permission.approval') || $rolePermission->can('permission.delete'))
                  {{-- <th width="4%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th> --}}
                  @endif
                  <th width="13%">ID</th>
                  <th width="13%">Name</th>
                  <th width="10%">Guard Name</th>
                  <th width="10%">Group Name</th>
                  @if($rolePermission->can('permission.edit') || $rolePermission->can('permission.delete'))
                  {{-- <th width="12%" align="right">Action</th> --}}
                  @endif
              </tr>
            </thead>
            <tbody>
        <?php $i=0; ?>
          @foreach($permissions as $permission)
        <?php $i++;
        //   if($permission->status!="" && $permission->status==1){
        //     $statusdis = '<span style="background:#006600; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-check"></i> </span>';
        //   }
        //   else{
        //     $statusdis = '<span style="background:#D91021; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-times"></i> </span>';
        //   }
        ?>

            <tr id="tablerow<?php echo $permission->id;?>" class="tablerow">
              @if($rolePermission->can('permission.approval') || $rolePermission->can('permission.delete'))
              {{-- <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $permission->id }}" /></td> --}}
              @endif
              <td>{{ $permission->id }}</td>
              <td>{{ $permission->name }}</td>
              <td>{{ $permission->guard_name }}</td>
              <td>{{ $permission->group_name }}</td>
              {{-- <th width="10%" align="center"><?php //echo $statusdis; ?></th> --}}
              @if($rolePermission->can('permission.edit') || $rolePermission->can('permission.delete'))
              {{-- <td align="right">
              @if($rolePermission->can('permission.edit'))
              <div style="width:50%; float:left">
                <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i> Edit</a>
              </div>
              @endif
              @if($rolePermission->can('permission.delete'))
              <div style="width:50%; float:left">
                  <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                    onclick="deleteSingle('<?php echo $permission->id;?>','masterdelete','permissions')"><i class="fa fa-trash"></i> Delete</button>
              </div>
              @endif
              </td> --}}
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
