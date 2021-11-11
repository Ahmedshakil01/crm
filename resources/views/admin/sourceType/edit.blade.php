@extends('admin.include.master')
@section('title') Edit Source Type - aleshamart @endsection
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
                            <h3 class="page-title">Edit Source Type</h3>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Edit Source Type</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
                            <li class=""><a  href="{{ route('sourceType.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Source Type List</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body p-0" style="margin-top: 30px;margin-bottom: 30px;">
                    <table class="table table-striped projects">
                        {!! Form::model($sourceType, ['route'=>['sourceType.update', $sourceType->id], 'method'=>'PATCH', 'class'=>'form-horizontal']) !!}
{{--
                        <form method="PATCH" action="{{ route('sourceType.update', $sourceType->id) }}" enctype="multipart/form-data">
--}}
                            @csrf
                            <div class="form-group row">
                                <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Source Type') }}</label>
                                <div class="col-md-6">
                                    <input required id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$sourceType->name}}" autofocus>
                                    <input id="id" type="hidden" class="form-control" name="id" value="{{$sourceType->id }}" autofocus>
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
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                       {{-- </form>--}}
                        {!! Form::close() !!}
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </div>
@endsection


