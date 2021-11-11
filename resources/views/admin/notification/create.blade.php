@extends('admin.include.master')
@section('title') New Email - aleshamart @endsection
@section('content')
    <style>
        .required{
            color:red;
            font-size:16px;
        }
    </style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- selec2 cdn --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="page-header" style="border:none">
                            <h3 class="page-title">Create New Email</h3>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">New Email</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
                            <li class=""><a  href="{{ route('notification.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Email List</a></li>
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
                        <form method="POST" action="{{ route('admin.notification.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="photo" class="col-md-2 col-form-label text-md-right">{{ __('Email Subject') }}</label>

                                <div class="col-md-6">
                                    <input id="subject" type="tex" class="form-control" name="subject">

                                    @if ($errors->has('subject'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">{{ __('Customer Email') }}</label>
                                <div class="col-md-6">
                                    <select name="user_id[]" id="user" class="form-control select2-multiple" multiple="multiple" required>
                                        <option selected disabled value="0">---Select Customer Email ---</option>
                                        @foreach($customers as $customer)
                                            @if($customer->email != null)
                                                <option value="{{$customer->id}}">{{$customer->email}}</option>
                                            @else
                                                {{-- <option selected disabled value="0">There have no user type</option> --}}
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
                            
                            <div class="form-group row">
                                <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Email Template Type') }}</label>
                                <div class="col-md-6">
                                    <select name="temp_type" class="form-control" id="temp_type">
                                        <option value="">---Select Email Template Type ---</option>
                                        @foreach($emailTemplateTypes as $notificationType)
                                        @if($notificationType->name != null)
                                                <option value="{{$notificationType->id}}">{{$notificationType->name}}</option>
                                            @else
                                                <option selected disabled value="0">There have no notificationtype</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('temp_type'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('temp_type') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="division_id" class="col-md-2 col-form-label text-md-right">{{ __('Email Body') }}</label>
                                <div class="col-md-6">
                                    <textarea name="details" id="details" cols="30" rows="10" class=" form-control{{ $errors->has('details') ? ' is-invalid' : '' }}" autofocus required onkeypress="messageCount()" onkeyup="messageCount()"></textarea>
                                    <p class="my-2"> Total Character Counter: <span id="wordCount">0</span> Character. Total Email: <span id="messageCount">0</span></p>
                                    @if ($errors->has('details'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="photo" class="col-md-2 col-form-label text-md-right">{{ __('Attach file') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image">

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Send') }}
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js" integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="">
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });
        </script>
        
        <script>
          $(document).ready(function() {
              // Select2 Multiple
              $('.select2-multiple').select2({
                  placeholder: "Select",
                  allowClear: true
              });
  
          });
      </script>
      <script>
    
        $(document).ready(function() {
            var templateType = $('#temp_type');
            templateType.change(function() {
                var templateTypeValue = $('#temp_type').val();
                let data={
                    id:templateTypeValue
                };
                axios.post("{{route('admin.email.template.ajax')}}", data)
                .then(function (response) {
                    console.log(response.data.message);
                    if (response.data.message) {
                        let message=response.data.message;
                        $('#details').val(message)
                        $('#wordCount').html(message.length)
                        $('#messageCount').html(Math.ceil((message.length)/160))
                    }else{
                        $('#details').attr("placeholder", "Data is not Available....");
                    }
                })
                .catch(function (error) {
                    console.log(error);
                })
      

            });
        });

        function messageCount() {
            let messageLenght= $('#details').val().length;
            $('#wordCount').html(messageLenght)
            $('#messageCount').html(Math.ceil(messageLenght/159))
        }

        $(document).ready(function() {
            $('#user').select2();
        });

        $('#user').select2({
        tags: true,
        multiple: true,
        tokenSeparators: [',']
        });

        function selectAllUser(params) {
            let selectAll= $('#selectAll');
            if (selectAll.is(":checked")) {
                $('#user').prop('disabled', true);
            }else{
                $('#user').prop('disabled', false);
            }
        }

        </script>

@endsection
