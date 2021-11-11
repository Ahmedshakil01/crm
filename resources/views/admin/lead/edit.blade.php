@extends('admin.include.master')
	@section('title') Edit Lead - Aleshamart @endsection
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
                <h3 class="page-title">Lead Information Edit</h3>
                </div>
              
                </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item active">Edit Lead - {{ $lead->fullname }}</li>
                </ol>
            </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
            @if(Auth::guard('administration')->user()->can('lead.detail'))
                <li>
                    <a  href="{{ route('admin.lead.details', $lead->id) }}" style="color: #fff; margin-right:20px" class="btn btn-warning btn-sm">
                    <i class="fa fa-info"></i> {{ $lead->fullname }}</a>
                </li>
            @endif
                <li class=""><a  href="{{ route('lead.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Lead List</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card">
          <div class="card-header">
            <div class="orderTabs">
                <ul>
                    <li><a href="#">General Information</a></li>
                    <li><a href="{{ route('attachment.index', ['id'=>$lead->id,'type'=>'lead']) }}">Attachment</a></li>
                    <li><a href="{{ route('meeting.index', ['id'=>$lead->id,'type'=>'lead']) }}">Invite Meeting</a></li>
                    <li><a href="{{ route('note.index', ['id'=>$lead->id,'type'=>'lead']) }}">Notes</a></li>
                    <li><a href="{{ route('email.index', ['id'=>$lead->id,'type'=>'lead']) }}">Email</a></li>
                </ul>
            </div>             
          </div>
          

          <div class="card-body p-0" style="margin-top: 30px; margin-bottom: 30px;">
            <table class="table table-striped projects">
                <form method="post" action="{{ route('admin.lead.update', $lead->id) }}" enctype="multipart/form-data">
                    @csrf
                  
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                            <label for="company" class="col-md-3 col-form-label text-md-right">{{ __('Company Name') }}<span class="required">*</span></label>
                            <div class="col-md-8">
                                <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company"  value="{{ $lead->company}}">
    
                                @if ($errors->has('company'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            <div class="form-group row">
                                <label for="owner_name" class="col-md-3 col-form-label text-md-right">{{ __('Owner Name') }}<span class="required">*</span></label>
                                 <div class="col-md-8">
                                    <input id="owner_name" type="text" class="form-control{{ $errors->has('owner_name') ? ' is-invalid' : '' }}" name="owner_name" value="{{ $lead->owner_name }}">
        
                                    @if ($errors->has('owner_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('owner_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact" class="col-md-3 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                                 <div class="col-md-8">
                                    <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{  $lead->contact }}">
        
                                    @if ($errors->has('contact'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telephone" class="col-md-3 col-form-label text-md-right">{{ __('Telephone Number') }}</label>
                                 <div class="col-md-8">
                                    <input id="telephone" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{  $lead->telephone }}">
        
                                    @if ($errors->has('telephone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telephone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact_person_name" class="col-md-3 col-form-label text-md-right">{{ __('Contact Person Name') }}</label>
                                 <div class="col-md-8">
                                    <input id="contact_person_name" type="text" class="form-control{{ $errors->has('contact_person_name') ? ' is-invalid' : '' }}" name="contact_person_name" value="{{  $lead->contact_person_name  }}">
        
                                    @if ($errors->has('contact_person_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_person_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact_person_mobile" class="col-md-3 col-form-label text-md-right">{{ __('Contact Person Mobile Name') }}</label>
                                 <div class="col-md-8">
                                    <input id="contact_person_mobile" type="text" class="form-control{{ $errors->has('contact_person_mobile') ? ' is-invalid' : '' }}" name="contact_person_mobile" value="{{ $lead->contact_person_mobile }}">
        
                                    @if ($errors->has('contact_person_mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('contact_person_mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>
                                 <div class="col-md-8">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{  $lead->email }}">
        
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alternate_email" class="col-md-3 col-form-label text-md-right">{{ __('Alternate Email') }}</label>
                                 <div class="col-md-8">
                                    <input id="alternate_email" type="alternate_email" class="form-control{{ $errors->has('alternate_email') ? ' is-invalid' : '' }}" name="alternate_email" value="{{ $lead->alternate_email }}">
        
                                    @if ($errors->has('alternate_email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alternate_email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fax" class="col-md-3 col-form-label text-md-right">{{ __('Fax') }}</label>
                                 <div class="col-md-8">
                                    <input id="fax" type="text" class="form-control" name="fax" value="{{  $lead->fax }}" autofocus>
        
                                    @if ($errors->has('fax'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fax') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('Address') }}</label>
        
                                 <div class="col-md-8">
                                    <textarea id="address" type="text" class="form-control" name="address">{{  $lead->address }}</textarea>
        
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="division_id" class="col-md-3 col-form-label text-md-right">{{ __('Division ') }}</label>
                                 <div class="col-md-8">
                                    <select name="division"  class=" form-control">
                                        <option value="">Select Division</option>
                                         @foreach($division as $division)
                                            <option value="{{ $division->id }}" @if ( $lead->division==  $division->id) {{'selected'}}@endif>{{ $division->name }}</option>
                                        @endforeach
                                    </select>
        
                                    @if ($errors->has('division_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('division_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="district_id" class="col-md-3 col-form-label text-md-right">{{ __('District') }}</label>
                                 <div class="col-md-8">
                                    <select name="district" id="district_id" class="district_id form-control">
                                        <option value="">Select District</option>
                                         @foreach($districts as $district)
                                            <option value="{{ $district->id }}" @if ( $lead->district==  $district->id) {{'selected'}}@endif>{{ $district->name }}</option>
                                        @endforeach
                                    </select>
        
                                    @if ($errors->has('district_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('district_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label for="area_id" class="col-md-3 col-form-label text-md-right">{{ __('Area') }}</label>
                                     <div class="col-md-8">
                                        <select name="area" id="area_id" class="form-control">
                                            <option value="">Select Area</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" @if ( $lead->area==  $area->id) {{'selected'}}@endif>{{ $area->name }}</option>
                                            @endforeach
                                        </select>
            
                                        @if ($errors->has('area_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('area_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zipcode" class="col-md-3 col-form-label text-md-right">{{ __('Zip Code') }}</label>
                                     <div class="col-md-8">
                                        <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ $lead->zipcode }}" autofocus>
            
                                        @if ($errors->has('zipcode'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('zipcode') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                             
                             
                        </div>
                        <div class="col-sm-6"> 
                            <div class="form-group row">
                                <label for="total_employee" class="col-md-3 col-form-label text-md-right">{{ __('Total Employee') }}</label>
                                 <div class="col-md-8">
                                    <input id="total_employee" type="number" class="form-control{{ $errors->has('total_employee') ? ' is-invalid' : '' }}" name="total_employee" value="{{ $lead->total_employee }}">
        
                                    @if ($errors->has('total_employee'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total_employee') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="annual_revenue" class="col-md-3 col-form-label text-md-right">{{ __('Annual Revenue') }}</label>
                                 <div class="col-md-8">
                                    <input id="annual_revenue" type="number" class="form-control{{ $errors->has('annual_revenue') ? ' is-invalid' : '' }}" name="annual_revenue" value="{{ $lead->annual_revenue }}">
        
                                    @if ($errors->has('annual_revenue'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('annual_revenue') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="details" class="col-md-3 col-form-label text-md-right">{{ __('Details') }}</label>
        
                                 <div class="col-md-8">
                                    <textarea id="details" type="text" class="form-control" name="details">{{ $lead->details }}</textarea>
        
                                    @if ($errors->has('details'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('details') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="skype_id" class="col-md-3 col-form-label text-md-right">{{ __('Skype Id') }}</label>
                                 <div class="col-md-8">
                                    <input id="skype_id" type="skype_id" class="form-control{{ $errors->has('skype_id') ? ' is-invalid' : '' }}" name="skype_id" value="{{ $lead->skype_id }}">
        
                                    @if ($errors->has('skype_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('skype_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facebook" class="col-md-3 col-form-label text-md-right">{{ __('Facebook Link') }}</label>
                                 <div class="col-md-8">
                                    <input id="facebook" type="facebook" class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}" 
                                    name="facebook" value="{{ $lead->facebook }}">
        
                                    @if ($errors->has('facebook'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('facebook') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="twitter" class="col-md-3 col-form-label text-md-right">{{ __('Twitter Link') }}</label>
                                 <div class="col-md-8">
                                    <input id="twitter" type="twitter" class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" 
                                    name="twitter" value="{{ $lead->twitter}}">
        
                                    @if ($errors->has('twitter'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('twitter') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="linkedin" class="col-md-3 col-form-label text-md-right">{{ __('Linkedin Link') }}</label>
                                 <div class="col-md-8">
                                    <input id="linkedin" type="linkedin" class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}" 
                                    name="linkedin" value="{{ $lead->linkedin }}">
        
                                    @if ($errors->has('linkedin'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('linkedin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="youtube" class="col-md-3 col-form-label text-md-right">{{ __('Youtube Link') }}</label>
                                 <div class="col-md-8">
                                    <input id="youtube" type="youtube" class="form-control{{ $errors->has('youtube') ? ' is-invalid' : '' }}" 
                                    name="youtube" value="{{ $lead->youtube }}">
        
                                    @if ($errors->has('youtube'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('youtube') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="division_id" class="col-md-3 col-form-label text-md-right">{{ __('Lead Source') }}</label>
                                 <div class="col-md-8">
                                    <select name="source" id="source" class="form-control">
                                        @foreach($leadsources as $sources)
                                            <option value="{{ $sources->id }}" @if ( $lead->sources==  $sources->id) {{'selected'}}@endif>{{ $sources->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">{{ __('Lead Status') }}</label>
                                 <div class="col-md-8">
                                    <select name="status" id="status" class="form-control">
                                        @foreach($leadstatus as $status)
                                            <option value="{{ $status->id }}" @if ( $lead->status==  $status->id) {{'selected'}}@endif>{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rating" class="col-md-3 col-form-label text-md-right">{{ __('Lead Rating') }}</label>
                                 <div class="col-md-8">
                                    <select name="rating" id="rating" class="form-control">
                                        @foreach($leadrating as $rating)
                                            <option value="{{ $rating->id }}" @if ( $lead->rating==  $rating->id) {{'selected'}}@endif>{{ $rating->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="industry" class="col-md-3 col-form-label text-md-right">{{ __('Lead Industry') }}</label>
                                 <div class="col-md-8">
                                    <select name="industry" id="industry" class="form-control">
                                        @foreach($leadindustry as $industry)
                                            <option value="{{ $industry->id }}" @if ( $lead->industry==  $industry->id) {{'selected'}}@endif>{{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="photo" class="col-md-3 col-form-label text-md-right">{{ __('Logo') }}</label>
        
                                 <div class="col-md-8">
                                   <input id="photo" type="file" class="form-control" name="photo" onchange="readURL('1',this,'selectImage')">
                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                 <div class="col-md-8 offset-md-2 text-center">
                                   <img src="{{ asset('uploads/leads/file/'.$lead->photo)}}" alt="{{$lead->company}}" width="300px" height="auto" id="selectImage1">
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
                    </div>
                </form>
            </table>
          </div>
    </section>
</div>
	
@endsection
