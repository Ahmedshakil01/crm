@extends('admin.include.master')
	@section('title') Offer List - Aleshamart @endsection
@section('content')
<?php
    $permission = Auth::guard('administration')->user();
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="page-header" style="border:none">
            <h3 class="page-title">View Offer List</h3>
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
            <li class="breadcrumb-item active">Offer List</li>
          </ol>
        </div>
        @if($permission->can('offer.approval') || $permission->can('offer.delete') || $permission->can('offer.create'))
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            @if($permission->can('offer.approval'))
            <li class=""><a  href="javascript:void()" onclick="permissions('offers','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
            <li class=""><a  href="javascript:void()" onclick="permissions('offers','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
            @endif
            @if($permission->can('offer.delete'))
            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','offers');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
            @endif
            @if($permission->can('offer.create'))
            <li class=""><a  href="{{ route('offer.create') }}" style="color:#fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Create New Offer</a></li>
            @endif
          </ol>
        </div>
        @endif
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Total List
          <span class="badge badge-pill badge-secondary">{{ count($alloffer) }}</span>
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body p-0">
          <form id="form_check">
            <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                @if($permission->can('offer.approval') || $permission->can('offer.delete'))
                  <th width="4%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                @endif
                  <th width="13%">Name</th>
                  <th width="24%">Category</th>
                  <th width="22%">Image</th>
                  <th width="15%">Meta Details</th>
                  <th width="15%">Keywords</th>
                  <th width="10%">Sequence</th>
                  <th width="10%">Status</th>
                @if($permission->can('offer.edit') || $permission->can('offer.delete'))
                  <th width="12%" align="right">Action</th>
                @endif
                </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                @foreach($alloffer as $offer)
                <?php $i++;
                  $categories = \App\Models\Category::where('id',$offer->cat_id)->first();
                  if($categories!=""){
                    $catnames = $categories->name;
                  }
                  else{
                    $catnames = '';
                  }

                  if($offer->status!="" && $offer->status==1){
                    $statusdis = '<span style="background:#006600; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-check"></i> </span>';
                  }
                  else{
                    $statusdis = '<span style="background:#D91021; padding:3px 8px; border-radius:5px; margin:2px;float:left; font-size:16px;text-align:center"><i class="fa fa-times"></i> </span>';
                  }
                ?>

                <tr id="tablerow<?php echo $offer->id;?>" class="tablerow">
                  @if($permission->can('offer.approval') || $permission->can('offer.delete'))
                  <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $offer->id }}" /></td>
                  @endif
                  <td>{{ $offer->name }}</td>
                  <td>{{ $catnames }}</td>
                  @php
                    $offer_img_explod = explode('.',$offer->image);
                  @endphp
                  <td><img src="{{ asset('uploads/offer/jpg/'.$offer_img_explod[0].'.jpg') }}" style="width:200px; height:auto" /></td>
                  <td>{{ $offer->meta_details }}</td>
                  <td>{{ $offer->keywords }}</td>
                  <td>{{ $offer->sequence }}</td>
                  <th width="10%" align="center"><?php echo $statusdis; ?></th>
                  @if($permission->can('offer.edit') || $permission->can('offer.delete'))
                  <td align="right">
                    @if($permission->can('offer.edit'))
                    <div style="width:50%; float:left">
                    <a href="{{ route('offer.edit', $offer->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a>
                    </div>
                    @endif
                    @if($permission->can('offer.delete'))
                    <div style="width:50%; float:left">
                        <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                          onclick="deleteSingle('<?php echo $offer->id;?>','masterdelete','offers')"><i class="fa fa-trash"></i></button>
                    </div>
                    @endif
                  </td>
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
</div>

@endsection
