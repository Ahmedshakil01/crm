@extends('admin.include.master')
	@section('title') New Customer - Aleshamart @endsection
@section('content')
<style>
.required{
	color:red;
	font-size:16px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="page-header" style="border:none">
                <h3 class="page-title">Create New Customer</h3>
                </div>
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
                    <li class="breadcrumb-item active">New Customer</li>
                </ol>
            </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
              <li class=""><a  href="{{ route('customer.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> View Customer List</a></li>
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
            <h3 class="card-title">Create</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body p-0" style="margin-top: 30px;margin-bottom: 30px;">
            <table class="table table-striped projects">
                <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-2 col-form-label text-md-right">{{ __('Phone') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}">

                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="col-md-2 col-form-label text-md-right">{{ __('Dath Of Birth') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="dob" type="date" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}">

                            @if ($errors->has('dob'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="assign_roles" class="col-md-2 col-form-label text-md-right">{{ __('Gender') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            {{-- <select name="roles[]" id="roles_assign" class="form-control select2" multiple> --}}
                            <select name="gender" class="form-control select2">

                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>

                            </select>


                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="assign_roles" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            {{-- <select name="roles[]" id="roles_assign" class="form-control select2" multiple> --}}
                            <select name="status" class="form-control select2">

                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>


                            </select>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="assign_roles" class="col-md-2 col-form-label text-md-right">{{ __('Source Type') }}</label>
                        <div class="col-md-6">
                            {{-- <select name="roles[]" id="roles_assign" class="form-control select2" multiple> --}}
                            <select name="source" class="form-control select2">
                                @foreach ($customersources as $customersource)
                                    <option value="{{ $customersource->name }}">{{ $customersource->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('assign_roles'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('assign_roles') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>




                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" autofocus>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}" autofocus>

                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
</div>

@endsection

