@extends('admin.include.master')
@section('title') Admin List - Aleshamart @endsection

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
            <h3 class="page-title">View Admin List</h3>
        </div>
        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
        {{-- @if (session()->has('messageType'))
          <div class="alert alert-{{ session()->get('messageType') }}" role="alert">
              <strong>STATUS: </strong> {{ session()->get('message') }}
          </div>
        @endif --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active">Admin List</li>
          </ol>
        </div>
        @if($permission->can('admin.approval') || $permission->can('admin.delete') || $permission->can('admin.create'))
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            @if($permission->can('admin.approval'))
              <li class=""><a  href="javascript:void()" onclick="permissions('administrations','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
              <li class=""><a  href="javascript:void()" onclick="permissions('administrations','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
            @endif
            @if($permission->can('admin.delete'))
              <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','administrations');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
            @endif
            @if($permission->can('admin.create'))
              <li class=""><a  href="{{ route('admins.create') }}" style="color:#fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Create New Admin</a></li>
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
          <span class="badge badge-pill badge-secondary">{{ count($alladmins) }}</span>
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
                    @if($permission->can('admin.approval') || $permission->can('admin.delete'))
                    <th width="1%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                    @endif
                    <th width="21%">Full Name</th>
                    <th width="11%">Username</th>
                    <th width="19%">Email</th>
                    <th width="12%">Contact</th>
                    <th width="20%">Roles</th>
                    <th width="20%">Designation</th>
                    <th width="7%">Status</th>
                    @if($permission->can('admin.edit') || $permission->can('admin.delete'))
                      <th width="9%" align="right">Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; ?>
                    @foreach($alladmins as $admin)
                  <?php $i++; ?>

                  <tr id="tablerow<?php echo $admin->id;?>" class="tablerow">
                    @if($permission->can('admin.approval') || $permission->can('admin.delete'))
                    <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $admin->id }}" /></td>
                    @endif
                    <td>{{ $admin->fullname }}</td>
                    <td>{{ $admin->username }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->contact }}</td>
                    <td>
                    @foreach ($admin->roles as $ad_role)
                        {{-- <span class="badge badge-info mr-1">
                          {{ $ad_role->name }}
                        </span> --}}
                        <button class="btn btn-outline-success btn-sm">{{ $ad_role->name }}</button>
                    @endforeach
                    </td>
                    <td>{{ $admin->designation }}</td>
                    <th width="7%" align="center">
                      @if ($admin->status!="" && $admin->status==1)
                        <span style="background:#006600; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-check"></i> </span>
                        @else
                          <span style="background:#D91021; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-times"></i> </span>
                      @endif

                    </th>
                    @if($permission->can('admin.edit') || $permission->can('admin.delete'))
                    <td align="right">
                      <div class="btn-group" role="group">
                      @if($permission->can('admin.edit'))
                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-sm btn-warning" style="font-size: 18px; float:left; padding:3px 10px; margin-right:5px;"><i class="fa fa-edit"></i></a>
                      @endif
                        {{-- <button type="button" class="btn btn-sm btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                          onclick="deleteSingle('<?php //echo $admin->id;?>','masterdelete','administrations')"><i class="fa fa-trash"></i> Delete</button> --}}
                      @if($permission->can('admin.delete'))
                        {{-- <a class="btn btn-danger text-white" href="{{ route('admins.destroy', $admin->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">
                            <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-{{ $admin->id }}" action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display: none;">
                          @method('DELETE')
                          @csrf
                        </form> --}}
                        <a href="#deleteModal{{ $admin->id }}" data-toggle="modal" class="btn btn-danger" style="font-size: 18px; float:left; padding:3px 10px;"> <i class="fa fa-trash"></i></a>
                        <!--Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                {{-- <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                                  <span aria-hidden="true">&times;</span>
                                </button> --}}
                              </div>
                              <div class="modal-body" style="text-align: center">
                                <h4><b>Are you sure?</b></h4>
                                <p>Do you want to Delete Selected data !</p>
                                <form action="{!! route('admins.destroy', $admin->id) !!}" method="post"> 
                                @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-danger">OK, Delete it</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </form>
                              </div>
                              
                              <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> --}}
                              </div>
                            </div>
                          </div>
                        </div>  
                      @endif
                      </div>

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
