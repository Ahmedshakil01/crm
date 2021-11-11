@extends('admin.include.master')
	@section('title') Edit Group - Aleshamart @endsection
@section('content')

<style type="text/css">
    section {
        padding: 60px 0;
    }

    section .section-title {
        text-align: center;
        color: #000;
        margin-bottom: 50px;
        text-transform: uppercase;
    }
    #tabs{
        width:100%;
        height:auto;
        float:left;
        color: #eee;
    }
    #tabs h6.section-title{
        color: #fff;
    }

    #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #fff;
        float:left;
        padding:5px 20px;
        border-bottom: 4px solid #292929;
        font-size: 20px;
        font-weight: bold;
        background:#666;
        text-decoration:none;
    }
    #tabs .nav-tabs .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
        color: #fff;
        font-size: 20px;
        float:left;
        padding:5px 20px;
        text-decoration:none;
    }
</style>

    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="page-header" style="border:none">
                    <h3 class="page-title">Group Edit</h3>
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
                        <li class="breadcrumb-item active">Edit - {{ $group->title }}</li>
                    </ol>
                </div>
              <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                  {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','groups');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
                  <li class=""><a  href="{{ route('group.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Group List</a></li>
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
                    {!! Form::model($group, ['route'=>['group.update', $group->id], 'files' => true, 'method'=>'PATCH', 'class'=>'form-horizontal', 'id="tabs"']) !!}
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $group->name }}">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
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
@endsection
