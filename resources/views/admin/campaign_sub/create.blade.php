@extends('admin.include.master')
	@section('title') New Sub Campaign - Aleshamart @endsection
@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    {{-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> --}}
    {{-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}

    <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="page-header" style="border:none">
                    <h3 class="page-title">Create New Sub Campaign</h3>
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
                        <li class="breadcrumb-item active">New Sub Campaign</li>
                    </ol>
                </div>
              <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                  {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
                  <li class=""><a  href="{{ route('campaign_sub.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> View Subcampaign List</a></li>
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
                    <form method="POST" action="{{ route('campaign_sub.store') }}" enctype="multipart/form-data" id="tabs">
                        @csrf

                        <div class="col-sm-12">                                    
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"  value="{{ old('name') }}"/>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Campaign Name') }}</label>
                                <div class="col-md-6">
                                    <select name="campaign_id" class="form-control">
                                        <option value="">Select Campaign</option>
                                        @foreach($campaigns as $campaign)
                                            <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                                        @endforeach
                                    </select>
    
                                    @if ($errors->has('campaign_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('campaign_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="start_date" class="col-md-2 col-form-label text-md-right">{{ __('Start Date') }}</label>
                                <div class="col-md-3">
                                    <input id="start_date" type="datetime-local" name="start_date" class="form-control"  value="{{ old('start_date') }}">
                                    @if ($errors->has('start_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">Example: dd/mm/yyyy h:m AM/PM</div>
                            </div>
                                
                            <div class="form-group row">
                                <label for="end_date" class="col-md-2 col-form-label text-md-right">{{ __('End Date') }}</label>
                                <div class="col-md-3">
                                    <input id="end_date" type="datetime-local" name="end_date" class="form-control"  value="{{ old('end_date') }}">
                                    @if ($errors->has('end_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-3">Example: dd/mm/yyyy h:m AM/PM</div>
                            </div>
                                
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <input id="thumb" type="file" class="form-control" name="thumb">

                                    @if ($errors->has('thumb'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('thumb') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Banner Photo') }}</label>
                                <div class="col-md-6">
                                    <input id="banner" type="file" class="form-control" name="banner">

                                    @if ($errors->has('banner'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('banner') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-6">
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
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


@endsection
 <script type="text/javascript">
	$(document).ready(function () {
		$('.date-picker').daterangepicker({
			singleDatePicker: true,
			calender_style: "picker_4"
		}, function (start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});
	});
</script>