@extends('admin.include.master')
	@section('title') Draft Mail - Aleshamart @endsection

@section('content')
<?php
  $permission = Auth::guard('administration')->user();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
  	.lists{
		width:100%;
		height:auto;
	}
	.lists a{
		width:100%;
		height:auto;
		color:#333;
		background:#fff;
	}
	.lists table tr td{
		font-size:15px;
		font-weight:normal;
	}
	.lists:hover{
		background:#ddd!important;
		box-shadow:#ddd 0 0 2px 2px;
	}
	.customtables{
		width:100%;
		height:auto;
		float:left;
		border:1px solid #ccc;
		padding:10px;
	}
	.customtables thead tr{
		background: #666;
		width: 100%;
		border-bottom:4px solid #AB1836;
	}
	.customtables thead tr th{
		text-align:center;
		height: 40px;
		padding: 10px;
	}
	.customtables tbody tr td{
		background:#F1F3F4;
		text-align:center;
		height: 30px;
		padding: 10px;
		border-bottom:1px solid #BCBCBC;
		color: #333;
		font-size:16px;
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div class="content-wrapper">
	<section class="content-header">
	  <div class="container-fluid">
		<div class="row mb-2">
		  <div class="col-sm-6">
			<div class="page-header" style="border:none">
			  <h3 class="page-title">Draft Mail List</h3>
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
			  <li class="breadcrumb-item active">Draft List</li>
			</ol>
		  </div>
		  @if($permission->can('support.multipleDelete') || $permission->can('support.compose') || $permission->can('support.inbox') || $permission->can('support.sentmail'))
		  <div class="col-sm-12">
			<ol class="breadcrumb float-sm-right">
			@if($permission->can('support.multipleDelete'))
			  <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','mailboxes');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
			@endif
			@if($permission->can('support.compose'))
			  <li class=""><a  href="{{ route('admin.newmail') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Compose Mail</a></li>
			@endif
			@if($permission->can('support.inbox'))
			  <li class=""><a  href="{{ route('admin.mailbox') }}" style="color:#fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> Inbox Mail</a></li>
			@endif
			@if($permission->can('support.sentmail')) 
			  <li class=""><a  href="{{ route('admin.sentmail') }}" style="color:#fff; margin-right:20px" class="btn btn-success btn-sm"><i class="fa fa-list"></i> Sent Mail</a></li>
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
			<span class="badge badge-pill badge-secondary">{{ count($allmails) }}</span>
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
						@if($permission->can('support.multipleDelete'))
							<th width="1%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
						@endif
							<th width="13%">To</th>
							<th width="53%">Subject</th>
							<th width="17%">Mail Type</th>
							<th width="17%">Date Time</th>
						</tr>
					</thead>                        
					<tbody>
					<?php $i = 0; ?>
					@foreach($allmails as $mails)
					<?php 
						if($mails->read_count > 0){
							$fontweight = 'normal';
						}
						else{
							$fontweight = 'bold';
						}
						$i++; 
					?>
						<tr>
							<td colspan="6" style="padding:0;">
								<div class="lists">
									<a href="{{ route('admin.maildetails',$mails->id)}}">
										<table width="100%">
										<tr>
										@if($permission->can('support.multipleDelete'))
											<td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $mails->id }}" /></td>
										@endif
											<td width="13%" style="background:none; border:none;font-weight:{{ $fontweight }};">{{ $mails->tomail }}</td>
											<td width="53%" style="background:none; border:none;font-weight:{{ $fontweight }};">{{ $mails->subject }}</td>
											<td width="17%" style="background:none; border:none;font-weight:{{ $fontweight }};">{{ ucfirst($mails->mailtype) }}</td>
											<td width="17%" style="background:none; border:none;font-weight:{{ $fontweight }};">{{ $mails->created_at }}</td>
										</tr>
									</table>
									</a>
								</div>
							</td>
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

