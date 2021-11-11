@extends('admin.include.master')
	@section('title') Edit - {{ $role->name }} - aleshamart @endsection
@section('content')
<style>
  .form-check-label {
    margin-bottom: 0;
    margin-left: 20px;
    text-transform: capitalize;
  }
</style>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="page-header" style="border:none">
                <h3 class="page-title">Role Information Edit</h3>
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
                    <li class="breadcrumb-item active">Edit - {{ $role->name }}</li>
                </ol>
            </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class=""><a  href="{{ route('role.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm">
              <i class="fa fa-list"></i> View Role List</a></li>
              <li><a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a></li>

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body p-0" style="margin-top: 30px;margin-bottom: 30px;">
            <table class="table table-striped projects">
                {!! Form::model($role, ['route'=>['role.update', $role->id], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
                <div class="form-group row">
                  <label for="name" class="col-md-2 col-form-label text-md-right">Role Name</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right">Permissions</label>
                <div class="col-md-6">
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="allPermissionCheck" value="1" {{ App\Models\Administration::roleHasPermissions($role, $allPermissions) ? 'checked' : '' }}>
                      <label class="form-check-label" for="allPermissionCheck">All</label>
                  </div>

                  @php $i = 1; @endphp
                  @foreach ($permissionGroup as $group)
                      <div class="row">
                        @php
                          $permissions = App\Models\Administration::getpermissionsByGroupName($group->name);
                          $j = 1;
                        @endphp
                          <div class="col-3">
                              <div class="form-check">
                                  <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\Models\Administration::roleHasPermissions($role, $allPermissions) ? 'checked' : '' }}>
                                  <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                              </div>
                          </div>

                          <div class="col-9 role-{{ $i }}-management-checkbox">

                              @foreach ($permissions as $permission)
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                      <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                  </div>
                                  @php  $j++; @endphp
                              @endforeach
                              <br>
                          </div>

                      </div>
                      @php  $i++; @endphp
                  @endforeach

                  @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>

              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4 pull-right">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
                {!! Form::close() !!}
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
</div>

<script>
  function checkPermissionByGroup(className, checkThis){
    const groupIdName = $("#"+checkThis.id);
    const classCheckBox = $('.'+className+' input');
      if(groupIdName.is(':checked')){
        classCheckBox.prop('checked', true);
      }else{
        classCheckBox.prop('checked', false);
      }
      implementAllChecked();
  }
  function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
    const classCheckbox = $('.'+groupClassName+ ' input');
    const groupIDCheckBox = $("#"+groupID);

      if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
        groupIDCheckBox.prop('checked', true);
      }else{
        groupIDCheckBox.prop('checked', false);
      }
        implementAllChecked();
  }

  function implementAllChecked() {
    const countPermissions = {{ count($allPermissions) }};
    const countPermissionGroups = {{ count($permissionGroup) }};
    //  console.log((countPermissions + countPermissionGroups));
    //  console.log($('input[type="checkbox"]:checked').length);
    if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
      $("#allPermissionCheck").prop('checked', true);
    }else{
      $("#allPermissionCheck").prop('checked', false);
    }
  }
</script>

@endsection

