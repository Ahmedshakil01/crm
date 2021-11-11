@extends('admin.include.master')
 @section('title') Lead Details - Aleshamart @endsection
@section('content')
<style>
 .payments{
   padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:15px;text-align:center; font-weight:bold;
 }
 .status{
   background:#006600; padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:12px;text-align:center
 }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
              <div class="page-header" style="border:none">
              <h3 class="page-title">Lead Detail Information</h3>
              </div>
              
              </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item">Settings</li>
                  <li class="breadcrumb-item active">Lead : {{ $lead_info->company }}</li>
              </ol>
          </div>
          <div class="col-sm-12" style="margin:15px;"> 
              <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm">Back</a>
            @if(Auth::guard('administration')->user()->can('news.edit'))  
              <a href="{{ route('lead.edit', $lead_info->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>Edit</a>
            @endif
        
            <ol class="breadcrumb float-sm-right">
               <li class=""><a  href="{{ route('lead.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> View Lead List</a></li>
          </ol>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<section class="content">
  <div class="container-fluid">
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">Profile Details </h3>
          </div>
          <div class="card-body">
           <div class="row">
                <div class="col-md-6">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th scope="row" class="">Status :</th>
                        <td>
                          @if ($lead_info->status == 1)
                            Active
                          @else
                            Deactive
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Company Name :</th>
                        <td>{{ $lead_info->company ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Owner Name :</th>
                        <td>{{ $lead_info->owner_name ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Photo :</th>
                        <td>
                        @if ($lead_info->photo != "")
                          <img style="max-width: 100px; height:auto;" src="{!! asset('uploads/leads/file/'.$lead_info->photo) !!}" alt="">
                          @else
                          Not Found!
                        @endif
                      </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Mobile :</th>
                        <td>{{ $lead_info->contact ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Telephone :</th>
                        <td>{{ $lead_info->telephone ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Email :</th>
                        <td>{{ $lead_info->email ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Alternate Email :</th>
                        <td>{{ $lead_info->alternate_email ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Contact Person Name :</th>
                        <td>{{ $lead_info->contact_person_name ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Contact Person Mobile :</th>
                        <td>{{ $lead_info->contact_person_mobile ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Address :</th>
                        <td>{{ $lead_info->address ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Division :</th>
                        <td>
                          @if ($lead_info->division != "")
                            {{ App\Models\Division::find($lead_info->division)->name }}
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">District :</th>
                        <td>
                          @if ($lead_info->district != "")
                            {{ App\Models\District::find($lead_info->district)->name }}
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Area :</th>
                        <td>
                          @if ($lead_info->area != "")
                            {{ App\Models\Area::find($lead_info->area)->name }}
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Zip Code :</th>
                        <td>{{ $lead_info->zipcode ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Fax :</th>
                        <td>{{ $lead_info->fax ?? ' ' }}</td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th scope="row" class="">Details :</th>
                        <td>{{ $lead_info->details ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Total Employee :</th>
                        <td>{{ $lead_info->total_employee ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Total Revenue :</th>
                        <td>{{ $lead_info->annual_revenue ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">skype_id :</th>
                        <td>{{ $lead_info->skype_id ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Facebook :</th>
                        <td>{{ $lead_info->facebook ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Twitter :</th>
                        <td>{{ $lead_info->twitter ?? ' ' }}</td>
                      </tr>
                        <th scope="row" class="">Linkedin :</th>
                        <td>{{ $lead_info->linkedin ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Youtube :</th>
                        <td>{{ $lead_info->youtube ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Source :</th>
                        @if ($lead_info->source != "")
                        <td> {{ App\Models\LeadSource::find($lead_info->source)->name }}</td>
                        @endif
                      </tr>
                      <tr>
                        <th scope="row" class="">Industry :</th> 
                        @if ($lead_info->industry != "")
                        <td> {{ App\Models\LeadIndustry::find($lead_info->industry)->name }}</td>
                        @endif
                      </tr>
                      <tr>
                        <th scope="row" class="">Rating :</th> 
                        @if ($lead_info->rating != "")
                        <td> {{ App\Models\LeadRating::find($lead_info->rating)->name }}</td>
                        @endif
                      </tr>
                      <tr>
                        <th scope="row" class="">Created_at :</th>
                        <td>{{ date('d-M-Y', strtotime($lead_info->created_at)); }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Updated_at :</th>
                        <td>{{ date('d-M-Y', strtotime($lead_info->updated_at)); }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
</div>
 
@endsection
