@extends('admin.include.master')
@section('title') New Article - aleshamart @endsection

@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="page-header" style="border:none">
                <h3 class="page-title">Create New Post</h3>
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
                    <li class="breadcrumb-item active">New Post</li>
                </ol>
            </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
              <li class=""><a  href="{{ route('news.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Post List</a></li>
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
                <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data" id="tabs">
                    @csrf
                    <div class="col-sm-12">
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist" style="margin:0; padding:0; background:#333; border-bottom:3px solid #666;">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General Information</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Images</a>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="margin-top:10px">


                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Headline') }}</label>

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
                                    <label for="publishdate" class="col-md-2 col-form-label text-md-right">{{ __('Publish Date') }}</label>

                                    <div class="col-md-6">
                                        <input id="publishdate" type="datetime-local" class="form-control" name="publishdate" value="{{ old('publishdate') }}" required autofocus>

                                        @if ($errors->has('publishdate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('publishdate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{-- <div class="col-md-3">Example: dd/mm/yyyy h:m AM/PM</div> --}}
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Post By') }}</label>

                                    <div class="col-md-6">
                                        <input id="postby" type="text" class="form-control{{ $errors->has('postby') ? ' is-invalid' : '' }}" name="postby" value="{{ Auth::user()->fullname }}" required autofocus>

                                        @if ($errors->has('postby'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('postby') }}</strong>
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
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" style="margin-top:10px">
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">Image</label>
                                        <div class="col-md-8">
                                            <input type="file" class="form-control" name="newsimages">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">File</label>
                                        <div class="col-md-8">
                                            <input type="file" class="form-control" name="newsfile">
                                        </div>
                                    </div>
                                </div>
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

