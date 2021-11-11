@extends('admin.include.master')
@section('title') New Notification - aleshamart @endsection
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
                            <h3 class="page-title">Create New Notification</h3>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>STATUS: </strong> {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">New Notification</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
                            <li class=""><a  href="{{ route('notification.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Notification List</a></li>
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
                        <form method="POST" action="{{ route('notification.update') }}" enctype="multipart/form-data" name="editNotificationForm">
                            @csrf
                            <div class="form-group row">
                                <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('User Type') }}</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{$notification->id}}">
                                    {{-- <input id="division_id" type="email" class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" value="{{ old('division_id') }}" autofocus> --}}
                                    <select name="user_type"  id="user_type" onchange="userFunction(this.value)" class="form-control user_type">
                                        <option selected disabled value="0">---Select User Type ---</option>
                                        @foreach($userTypes as $userType)
                                            @if($userType->name != null)
                                                <option value="{{$userType->id}}">{{$userType->name}}</option>
                                            @else
                                                <option selected disabled value="0">There have no user type</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_type'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_type') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div  id="merchant_area" style="display: none">
                                <div class="form-group row ">
                                    <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Merchants') }}</label>
                                    <div class="col-md-6">
                                        <select name="merchant_id" class="form-control">
                                            <option selected disabled value="">---Select User Type ---</option>
                                            @foreach($merchants as $merchant)
                                                @if($merchant->name)
                                                    <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('merchant_id'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('merchant_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="user_area" style="display: none">
                                <div class="form-group row">
                                    <label for="" class="col-md-2 col-form-label text-md-right">{{ __('Customer') }}</label>
                                    <div class="col-md-6">
                                        <select name="user_id" class="form-control">
                                            <option selected disabled value="0">---Select Customer Type ---</option>
                                            @foreach($customers as $customer)
                                                @if($customer->fullname != null)
                                                    <option value="{{$customer->id}}">{{$customer->fullname}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                            @if ($errors->has('user_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('user_id') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Notification Type') }}</label>
                                <div class="col-md-6">
                                    {{-- <input id="division_id" type="email" class="form-control{{ $errors->has('division_id') ? ' is-invalid' : '' }}" name="division_id" value="{{ old('division_id') }}" autofocus> --}}
                                    <select id="topic_type" name="topic_type" class="form-control">
                                        <option selected disabled value="0">---Select Notification Type ---</option>
                                        @foreach($notificationTypes as $notificationType)
                                            @if($notificationType->name != null)
                                                <option value="{{$notificationType->id}}">{{$notificationType->name}}</option>
                                            @else
                                                <option selected disabled value="0">There have no notificationtype</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('topic_type'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('topic_type') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Details') }}</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="id" value="{{$notification->id}}">
                                    <textarea id="details" type="text" class="form-control ckeditor" name="details"  required autofocus>{{$notification->details}}</textarea>

                                    @if ($errors->has('details'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="photo" class="col-md-2 col-form-label text-md-right">{{ __('Photo') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image" accept="image/*">
                                    <br>
                                    <img src="{{ asset('uploads/notification/'.$notification->image) }}" alt="" height="100" width="120">
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-6">
                                    <select name="status" class="form-control">
                                        <option value="1" class="form-control">Active</option>
                                        <option value="0" class="form-control">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
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
    <script>
        document.forms['editNotificationForm'].elements['user_type'].value="{{$notification->user_type}}"
        document.forms['editNotificationForm'].elements['topic_type'].value="{{$notification->topic_type}}"
    </script>
     <script>
        function userFunction(status){

            if(status == 2){
                document.getElementById("merchant_area").style.display = 'inline';
                document.getElementById("user_area").style.display = 'none';
            }
            else if(status == 1){
                document.getElementById("merchant_area").style.display = 'none';
                document.getElementById("user_area").style.display = 'inline';
            }
            else{
                document.getElementById("merchant_area").style.display = 'none';
                document.getElementById("user_area").style.display = 'none';
            }

        }
        </script>

@endsection

