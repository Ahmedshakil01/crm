 @extends('admin.include.master')
	@section('title') Guest List - Aleshamart @endsection
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
            <h3 class="page-title">View Guest List</h3>
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
            <li class="breadcrumb-item active">Guest List</li>
          </ol>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class=""><a  href="javascript:void()" onclick="permissions('customers','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
            <li class=""><a  href="javascript:void()" onclick="permissions('customers','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','customers');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
            {{-- <li class=""><a  href="{{ route('customer.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Guest</a></li> --}}
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Total List
          <span class="badge badge-pill badge-secondary">{{ count($allcustomer) }}</span>
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
          <form id="form_check">
            <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="1%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                  <th width="8%">Fullname</th>
                  <th width="8%">Mobile</th>
                  <th width="8%">Username</th>
                  <th width="8%">Email</th>
                  <th width="8%">Country</th>
                  <th width="8%">City</th>
                  <th width="2%">User Type</th>
                  {{-- <th width="8%">Area</th> --}}
                  <th width="2%">Status</th>
                  <!-- <th width="6%" align="right">Action</th>-->
                </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                        @foreach($allcustomer as $customer)
                        <?php $i++;
                    if($customer->active!="" && $customer->active==1){
                      $statusdis = '<span style="background:#006600;" class="status"><i class="fa fa-check"></i> </span>';
                    }
                    else{
                      $statusdis = '<span style="background:#D91021;"  class="status"><i class="fa fa-times"></i> </span>';
                    }

                    $countries = App\Models\Country::where('id',$customer->country);
                    if($countries->count() > 0){
                      $countryname = $countries->first();
                      $cnames = $countryname->name;
                    }
                    else{
                      $cnames = '';
                    }

                  ?>

              <tr id="tablerow<?php echo $customer->id;?>" class="tablerow">
                <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $customer->id }}" /></td>
                <td>{{ $customer->fullname }}</td>
                <td>{{ $customer->contact }}</td>
                <td>{{ $customer->username }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $cnames }}</td>
                <td>{{ $customer->city }}</td>
                <td>{{ $customer->type }}</td>
                {{-- <td>{{ $customer->area }}</td> --}}
                <th width="2%" align="center"><?php echo $statusdis; ?></th>
                <?php /*?><td align="right">
                <div style="width:50%; float:left">
                  <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a>                              </div>
                <div style="width:50%; float:left">
                    <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                      onclick="deleteSingle('<?php echo $customer->id;?>','masterdelete','customers')"><i class="fa fa-trash"></i></button>
                </div>                              </td><?php */?>
              </tr>
              @endforeach
            </tbody>
            </table>
          </form>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
</div>
@endsection
