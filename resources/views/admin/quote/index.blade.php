@extends('admin.include.master')
@section('title') Contact List - Aleshamart @endsection
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
          <h3 class="page-title">View Contact List</h3>
      </div>
        
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item">Settings</li>
          <li class="breadcrumb-item active">Contact List</li>
        </ol>
      </div>
      @if($permission->can('news.approval') || $permission->can('news.delete') || $permission->can('news.create'))
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
       
        @if($permission->can('news.delete'))
          <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','contacts');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
        @endif
        @if($permission->can('news.create'))
          <li class=""><a  href="{{ route('contact.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Contact</a></li>
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
        
        <span class="badge badge-pill badge-secondary">{{ $allcontactsource ? count($allcontactsource): '' }}</span>
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
              @if($permission->can('news.approval') || $permission->can('news.delete'))
                <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
              @endif
                <th width="10%">Fullname</th>
                <th width="10%">Owner name</th>
                <th width="10%">Mobile</th>
                <th width="10%">Email</th>
                <th width="10%">Division</th>
                <th width="10%">District</th>
                <th width="10%">Area</th>
                <th width="10%">Status</th>
              @if($permission->can('news.edit') || $permission->can('contacts.delete') || $permission->can('contacts.detail') )
                <th width="8%" align="right">Action</th>
              @endif
              </tr>
            </thead>
            <tbody>
            <?php $i=0; ?>
            @foreach($allcontactsource as $contact)
            <?php $i++;
            if($contact->status!="" && $contact->status==1){
              $statusdis = '<span style="background:#006600;" class="status"><i class="fa fa-check"></i> </span>';
            }
            else{
              $statusdis = '<span style="background:#D91021;"  class="status"><i class="fa fa-times"></i> </span>';
            }

              $divisions = App\Models\Division::where('id',$contact->division);
              if($divisions->count() > 0){
                $divisionname = $divisions->first();
                $divnames = $divisionname->name;
              }
              else{
                $divnames = '';
              }

              $districts = App\Models\District::where('id',$contact->district);
              if($districts->count() > 0){
                $districtname = $districts->first();
                $distnames = $districtname->name;
              }
              else{
                $distnames = '';
              }

              $areas = App\Models\Area::where('id',$contact->area);
              if($areas->count() > 0){
                $areaname = $areas->first();
                $areanames = $areaname->name;
              }
              else{
                $areanames = '';
              }

            ?>

            <tr id="tablerow<?php echo $contact->id;?>" class="tablerow">
              @if($permission->can('news.approval') || $permission->can('contact.delete'))
              <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $contact->id }}" /></td>
             @endif
              <td>{{ $contact->company }}</td>
              <td>{{ $contact->owner_name }}</td>
              <td>{{ $contact->contact }}</td>
              <td>{{ $contact->email }}</td>
              <td>{{ $divnames }}</td>
              <td>{{ $distnames }}</td>
              <td>{{ $areanames }}</td>
          
              <th width="2%" align="center"><?php echo $statusdis; ?></th>
              @if($permission->can('news.edit') || $permission->can('news.delete'))
              <td align="right" class="btn-group">
                @if($permission->can('news.edit'))
                <a href="{{route('contact.edit', $contact->id)}}" class="btn btn-sm btn-warning" style="font-size: 12px; float:left; padding:6px 4px; margin-right: 5px;"><i class="fa fa-edit"></i></a>
                @endif
                @if($permission->can('news.edit'))
                <a href="{{ route('admin.contact.details', $contact->id) }}" class="btn btn-sm btn-info" style="font-size: 12px; float:left; padding:6px 10px; margin-right: 5px;"><i class="fa fa-info"></i></a>
                @endif
                @if($permission->can('news.delete'))
                  <button type="button" class="btn btn-sm btn-danger" style="font-size: 12px; padding:6px"
                    onclick="deleteSingle('<?php echo $contact->id;?>','masterdelete','contacts')"><i class="fa fa-trash"></i></button>
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
