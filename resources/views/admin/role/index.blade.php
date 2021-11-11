 @extends('admin.include.master')
	@section('title') Role List - Aleshamart @endsection
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
            <h3 class="page-title">View Role List</h3>
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
            <li class="breadcrumb-item active">Role List</li>
          </ol>
        </div>
        @if($rolePermission->can('roles.approval') || $rolePermission->can('roles.delete') || $rolePermission->can('roles.create'))
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
          {{--@if($rolePermission->can('roles.approval'))
            <li class=""><a  href="javascript:void()" onclick="permissions('roles','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
            <li class=""><a  href="javascript:void()" onclick="permissions('roles','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
          @endif--}}
          @if($rolePermission->can('roles.delete'))
            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','roles');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
          @endif
          @if($rolePermission->can('roles.create'))
            <li class=""><a  href="{{ route('role.create') }}" style="color:#fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Create New Role</a></li>
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
          <span class="badge badge-pill badge-secondary">{{ count($roles) }}</span>
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
                      @if($rolePermission->can('roles.approval') || $rolePermission->can('roles.delete'))
                      <th width="5%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                      @endif
                      <th width="10%">Name</th>
                      <th width="65%">Permissions</th>
                      {{-- <th width="10%">Status</th> --}}
                      <th width="10%">Created At</th>
                      @if($rolePermission->can('roles.edit') || $rolePermission->can('roles.delete'))
                      <th width="10%" align="right">Action</th>
                      @endif
                  </tr>
                </thead>
                <tbody>
            <?php $i=0; ?>
              @foreach($roles as $role)
            <?php $i++;
              // if($role->status!="" && $role->status==1){
              //   $statusdis = '<span style="background:#006600; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-check"></i> </span>';
              // }
              // else{
              //   $statusdis = '<span style="background:#D91021; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-times"></i> </span>';
              // }
            ?>

                <tr id="tablerow<?php echo $role->id;?>" class="tablerow">
                  @if($rolePermission->can('roles.approval') || $rolePermission->can('roles.delete'))
                  <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $role->id }}" /></td>
                  @endif
                  <td>{{ $role->name }}</td>
                  <td>
                    @foreach ($role->permissions as $permission)
                        <button class="btn btn-info btn-sm" style="margin-left: 1px; margin-bottom:2px;" type="button">
                          <i class="fas fa-shield-alt"></i> {{ $permission->name }}
                        </button>
                    @endforeach
                  </td>
                  <td><span class="tag tag-success">{{ $role->created_at }}</span></td>
                  {{-- <th width="10%" align="center"><?php //echo $statusdis; ?></th> --}}
                  @if($rolePermission->can('roles.edit') || $rolePermission->can('roles.delete'))
                  <td align="right">

                  @if($rolePermission->can('roles.edit'))
                  <div style="width:50%; float:left">
                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm" style="font-size: 20px; float:left; padding:3px 6px"><i class="fa fa-edit"></i></a>
                  </div>
                  @endif

                  @if($rolePermission->can('roles.delete'))
                  <div style="width:50%; float:left">
                      <button type="button" class="btn btn-danger btn-sm" style="font-size: 20px; float:left; padding:3px 6px"
                        onclick="deleteSingle('<?php echo $role->id;?>','masterdelete','roles')"><i class="fa fa-trash"></i></button>
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
