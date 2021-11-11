@extends('admin.include.master')
@section('title') New Article - aleshamart @endsection

@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="page-header" style="border:none">
                <h3 class="page-title">Create New Rating</h3>
                </div>
                </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">New Rating</li>
                </ol>
            </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class=""><a  href="{{ route('lead_rating.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Rating List</a></li>
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


          </div>
          <div class="card-body p-0" style="margin-top: 30px;margin-bottom: 30px;">
            <table class="table table-striped projects">
                <form method="POST" action="{{ route('lead_rating.store') }}" enctype="multipart/form-data" id="tabs">
                    @csrf
                    <div class="col-sm-12">
                        	 <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
							 <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Details') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="details" type="text" class="form-control ckeditor" name="details" autofocus></textarea>

                                        @if ($errors->has('details'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('details') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                             <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}</label>
                                    <div class="col-md-6">
                                        <select name="status" class="form-control">
                                        	<option value="Display">Display</option>
                                            <option value="No Display">No Display</option>
                                        </select>
                                    </div>
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
    function ajaxSearch(keywords,id,colid,table)
    {
        //alert(keywords);
        if(keywords==0 ){
            return false;
        }
        else{
              var surl = 'ajaxsearch';
              $.ajax({
                type: "GET",
                url: surl,
                data: {'keywords':keywords,'table':table,'colid':colid},

                cache: false,
                beforeSend: function(){
                    $('#LoadingImageE').show();
                },
                complete: function(){
                    $('#LoadingImageE').hide();
                },
                success: function(response) {
                      $('#'+id).html(response);
                      $("#LoadingImageE").hide();
                },
                error: function (xhr, status) {
                  $("#LoadingImageE").hide();
                  alert('Unknown error ' + status);
                }
              });
        }
    }
</script>
@endsection

