@extends('admin.include.master') 
	@section('title') New Offer - Aleshamart @endsection 
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="page-header" style="border:none">
                <h3 class="page-title">Create New Offer</h3>
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
                    <li class="breadcrumb-item active">New Offer</li>
                </ol>
            </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              {{-- <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','return_causes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li> --}}
              <li class=""><a  href="{{ route('offer.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i>View Offer List</a></li>
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
                <form method="POST" action="{{ route('offer.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                            <label for="cat_id" class="col-md-2 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select class="cat_id form-control" name="cat_id" id="cat_id">
                                    <option value="">Select Category</option>
                                    @php
                                    $allcategory = App\Models\Category::all();
                                    @endphp

                                    @foreach ($allcategory as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('cat_id'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cat_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subcat_id" class="col-md-2 col-form-label text-md-right">{{ __('First Category') }}</label>

                            <div class="col-md-6">
                                    <select class="subcat_id form-control" name="subcat_id" id="subcat_id">
                                        <option value="">Select First Category</option>
                                    </select>

                                @if ($errors->has('subcat_id'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subcat_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Offer Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>
                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control" name="image">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('URL (Optional)') }}</label>
                        <div class="col-md-6">
                            <input id="url" type="text" class="form-control" name="url" value="{{ old('url') }}">
                        </div>
                    </div>                        
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Meta Details') }}</label>
                        <div class="col-md-6">
                            <input id="meta_details" type="text" class="form-control" name="meta_details" value="{{ old('meta_details') }}" required>
                            @if ($errors->has('meta_details'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('meta_details') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Keywords') }}</label>
                        <div class="col-md-6">
                            <input id="keywords" type="text" class="form-control" name="keywords" value="{{ old('keywords') }}" required>
                            @if ($errors->has('keywords'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('keywords') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Sequence') }}</label>
                        <div class="col-md-6">
                            <input id="sequence" type="number" class="form-control" name="sequence" value="{{ old('sequence') }}" required style="width:30%">
                            @if ($errors->has('sequence'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('sequence') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}</label>
                        <div class="col-md-6">
                           <select name="status" class="form-control">
                                <option value="1">Display</option>
                             <option value="0">Not Display</option>
                           </select>
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
{{-- <script>
function ajaxSearch(id)
{
  var surl = '{{ route("offer.ajaxsearch") }}';
  $.ajax({ 
	type: "GET", 
	url: surl,  
	data: {'id':id},			
	cache: false,
	success: function(response) { 
		  $('#subcatid').html(response);
	}, 
	error: function (xhr, status) {  
	  alert('Unknown error ' + status); 
	}    
  });
}
</script> --}}