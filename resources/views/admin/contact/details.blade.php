@extends('admin.include.master')
 @section('title') Contact Details - Aleshamart @endsection
@section('content')
<?php
$permission = Auth::guard('administration')->user();
?>
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
              <h3 class="page-title">Contact Detail Information</h3>
              </div>
           
              </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item">Settings</li>
                  <li class="breadcrumb-item active">Contact : {{ $contact_info->company }}</li>
              </ol>
          </div>
          <div class="col-sm-12" style="margin:15px;"> 
              <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm">Back</a>
            @if(Auth::guard('administration')->user()->can('news.edit'))  
              <a href="{{ route('contact.edit', $contact_info->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>Edit</a>
            @endif
           
            <ol class="breadcrumb float-sm-right">
                @if($permission->can('news.create'))
                  <li class=""><a  href="{{ route('admin.quate.create', $contact_info->id) }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create Quote</a></li>
                @endif
               <li class=""><a  href="{{ route('contact.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> View Contact List</a></li>
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
                          @if ($contact_info->status == 1)
                            Active
                          @else
                            Deactive
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Company Name :</th>
                        <td>{{ $contact_info->company ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Owner Name :</th>
                        <td>{{ $contact_info->owner_name ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Photo :</th>
                        <td>
                        @if ($contact_info->photo != "")
                          <img style="max-width: 100px; height:auto;" src="{!! asset('uploads/contacts/file/'.$contact_info->photo) !!}" alt="">
                          @else
                          Not Found!
                        @endif
                      </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Mobile :</th>
                        <td>{{ $contact_info->contact ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Telephone :</th>
                        <td>{{ $contact_info->telephone ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Email :</th>
                        <td>{{ $contact_info->email ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Alternate Email :</th>
                        <td>{{ $contact_info->alternate_email ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Contact Person Name :</th>
                        <td>{{ $contact_info->contact_person_name ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Contact Person Mobile :</th>
                        <td>{{ $contact_info->contact_person_mobile ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Address :</th>
                        <td>{{ $contact_info->address ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Division :</th>
                        <td>
                          @if ($contact_info->division != "")
                            {{ App\Models\Division::find($contact_info->division)->name }}
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">District :</th>
                        <td>
                          @if ($contact_info->district != "")
                            {{ App\Models\District::find($contact_info->district)->name }}
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Area :</th>
                        <td>
                          @if ($contact_info->area != "")
                            {{ App\Models\Area::find($contact_info->area)->name }}
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Zip Code :</th>
                        <td>{{ $contact_info->zipcode ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Fax :</th>
                        <td>{{ $contact_info->fax ?? ' ' }}</td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th scope="row" class="">Details :</th>
                        <td>{{ $contact_info->details ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Total Employee :</th>
                        <td>{{ $contact_info->total_employee ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Total Revenue :</th>
                        <td>{{ $contact_info->annual_revenue ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">skype_id :</th>
                        <td>{{ $contact_info->skype_id ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Facebook :</th>
                        <td>{{ $contact_info->facebook ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Twitter :</th>
                        <td>{{ $contact_info->twitter ?? ' ' }}</td>
                      </tr>
                        <th scope="row" class="">Linkedin :</th>
                        <td>{{ $contact_info->linkedin ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Youtube :</th>
                        <td>{{ $contact_info->youtube ?? ' ' }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Source :</th>
                        @if ($contact_info->source != "")
                        <td> {{ App\Models\LeadSource::find($contact_info->source)->name }}</td>
                        @endif
                      </tr>
                      <tr>
                        <th scope="row" class="">Industry :</th> 
                        @if ($contact_info->industry != "")
                        <td> {{ App\Models\LeadIndustry::find($contact_info->industry)->name }}</td>
                        @endif
                      </tr>
                      <tr>
                        <th scope="row" class="">Rating :</th> 
                        @if ($contact_info->rating != "")
                        <td> {{ App\Models\LeadRating::find($contact_info->rating)->name }}</td>
                        @endif
                      </tr>
                      <tr>
                        <th scope="row" class="">Created_at :</th>
                        <td>{{ date('d-M-Y', strtotime($contact_info->created_at)); }}</td>
                      </tr>
                      <tr>
                        <th scope="row" class="">Updated_at :</th>
                        <td>{{ date('d-M-Y', strtotime($contact_info->updated_at)); }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
          <div class="container-fluid p-5">
            <div class="row">
              <div class="col-md-12">
                  <table class="table table-bordered">
                        <thead>
                          <tr>
                              <th style="width: 5%;">Sl No</th>
                              <th>Quote Owner</th>
                              <th>Status</th>
                              <th>Subject</th>
                              <th>Team</th>
                              <th>Deal Name</th>
                              <th>Valid Until</th>
                              <th>Action</th> 
                          </tr>
                        </thead>
                        <tbody>
                          
                          @foreach ($contact_info->quotes as $key=> $quotes)
                            <tr  id="tablerow<?php echo $quotes->id;?>">
                              <td>{{ $key+1 ?? " "}}</td>
                              <td>{{ $quotes->quote_owner ?? " "}}</td>
                              <td>{{ $quotes->status ?? " "}}</td>
                              <td>{{ $quotes->subject ?? " "}}</td>
                              <td>{{ $quotes->team ?? " "}}</td>
                              <td>{{ $quotes->deal_name ?? " "}}</td>
                              <td>{{ $quotes->valid_until ?? " "}}</td>
                             <td>
                              @if($permission->can('news.edit'))
                              <a href="{{ route('admin.quote.details', $quotes->id) }}" class="btn btn-sm btn-info" style="font-size: 12px; float:left; padding:6px 10px; margin-right: 5px;"><i class="fa fa-info"></i></a>
                              @endif
                              @if($permission->can('news.delete'))
                                <button type="button" class="btn btn-sm btn-danger" style="font-size: 12px; padding:6px"
                                  onclick="deleteSingle('<?php echo $quotes->id;?>','/administration/masterdelete','quotes')"><i class="fa fa-trash"></i></button>
                              @endif
                             </td>
                            </tr>
                          @endforeach
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
