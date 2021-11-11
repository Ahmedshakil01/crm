@extends('admin.include.master')
@section('title') Edit - {{ $company->name }} - Aleshamart @endsection
@section('content')
<style>
input[type=radio]:checked ~ label{
  color: #003399;
}
</style>
    <div class="content-wrapper">

        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h2>Website Settings</h2>
                </div>
                <div class="card-body p-0" style="margin-top: 30px;margin-bottom: 30px;">
                    @if (session()->has('message'))
                        <div class="alert alert-success }}" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <table class="table table-responsive table-striped projects">
                        {!! Form::model($company, ['route'=>['companyprofile.update', $company->id], 'files' => true, 'method'=>'POST', 'class'=>'form-horizontal']) !!}
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Company Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $company->name }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Company Logo') }}</label>

                            <div class="col-md-6">

                                <input id="image" type="file" style="font-size:10px;" name="logo" onchange="readURL('0',this,'selectImage')">
                                <input type="hidden" name="exist_logo" value="{{ $company->logo }}"/>
                                @if ($errors->has('logo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif

                                @if($company->logo!="")
                               	 <img style="width:60px; height:auto" id="selectImage0" src="{{ asset('uploads/companyprofile/logo/'.$company->logo) }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Company Banner') }}</label>

                            <div class="col-md-6">

                                <input id="image" type="file" style="font-size:10px;" name="banner" onchange="readURL('1',this,'selectImage')">
                                <input type="hidden" name="exist_banner" value="{{ $company->banner }}"/>
                                @if ($errors->has('banner'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('banner') }}</strong>
                                    </span>
                                @endif
                                @if($company->banner!="")
                                	<img style="width:120px; height:auto" id="selectImage1" src="{{ asset('uploads/companyprofile/banner/'.$company->banner) }}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Company Icon') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" style="font-size:10px;" name="icon" onchange="readURL('2',this,'selectImage')">
                                <input type="hidden" name="exist_icon" value="{{ $company->icon }}"/>
                                @if ($errors->has('icon'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('icon') }}</strong>
                                    </span>
                                @endif

                            	@if($company->icon!="")
                                <img style="width:30px; height:auto" id="selectImage2" src="{{ asset('uploads/companyprofile/icon/'.$company->icon) }}">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Contact No.') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="{{ $company->contact }}" required>
                                @if ($errors->has('contact'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hotline" class="col-md-2 col-form-label text-md-right">{{ __('Hotline/Call Center') }}</label>
                            <div class="col-md-6">
                                <input id="hotline" type="text" class="form-control" name="hotline" value="{{ $company->hotline }}" required>
                                @if ($errors->has('hotline'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('hotline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Company Email') }}</label>
                            <div class="col-md-6">
                                <input id="contact" type="email" class="form-control" name="email" value="{{ $company->email }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-2 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ $company->city }}" required>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="area" class="col-md-2 col-form-label text-md-right">{{ __('Area') }}</label>
                            <div class="col-md-6">
                                <input id="area" type="text" class="form-control" name="area" value="{{ $company->area }}" required>
                                @if ($errors->has('area'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zipcode" class="col-md-2 col-form-label text-md-right">{{ __('Zipcode') }}</label>
                            <div class="col-md-6">
                                <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ $company->zipcode }}" required>
                                @if ($errors->has('zipcode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <textarea id="address" class="form-control" name="address">{{ $company->address }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Language') }}</label>
                            <div class="col-md-6">
                                	<select name="language" class="form-control">
                                    	<option value="English">English</option>
                                        <option value="Bangla">Bangla</option>
                                    </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Currency') }}</label>
                            <div class="col-md-6">
                                	<input name="currency" class="form-control" value="Tk">
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
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
<script type="text/javascript" src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script>
function ajaxSearch(keywords,id,colid,table)
{
	if(keywords==0 ){
		return false;
	}
	else{
		  var surl = '{{ route("ajaxstate") }}';
		  $.ajax({
			type: "GET",
			url: surl,
			data: {'keywords':keywords,'table':table,'colid':colid},
			cache: false,
			success: function(response) {
				  $('#'+id).html(response);
				  $('#statelabel').css('display','none');
			},
			error: function (xhr, status) {
			  alert('Unknown error ' + status);
				  $('#statelabel').css('display','inline');
			}
		  });
	}
}

</script>
@endsection

