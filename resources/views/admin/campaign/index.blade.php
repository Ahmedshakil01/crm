@extends('admin.include.master')
	@section('title') Campaign List - Aleshamart @endsection
@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="page-header" style="border:none">
            <h3 class="page-title">View Campaign List</h3>
          </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Sales Module</li>
            <li class="breadcrumb-item">Campaign</li>
            <li class="breadcrumb-item active">Campaign List</li>
          </ol>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            {{--<li class=""><a  href="javascript:void()" onclick="permissions('campaigns','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
            <li class=""><a  href="javascript:void()" onclick="permissions('campaigns','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','campaigns');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
            <li class=""><a  href="{{ route('campaign.create') }}" style="color:#fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Create New Campaign</a></li>--}}
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
          <span class="badge badge-pill badge-secondary">{{ count($allcampaigns) }}</span>
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
{{--                <th>SL</th>--}}
                <th>ID</th>
                <th>Title</th>
                <th>Cover Photo</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php $i=1; @endphp
              @foreach($allcampaigns as $campaign)
              <tr>
{{--                <td>{{ $i++ }}</td>--}}
                <td>{{ $campaign->id }}</td>
                <td>{{ $campaign->title }}</td>
                <td>{{ $campaign->photo }}</td>
                <td> @if($campaign->status == 'active')
                       <label class="btn btn-sm btn-success">Active</label>
                     @elseif($campaign->status == 'inactive')
                       <label class="btn btn-sm btn-danger">Inactive</label>
                     @endif
                </td>
                <td>{{ $campaign->created_at }}</td>
                <td>{{ $campaign->updated_at }}</td>
                <td><a href="{{ route('campaign.show', $campaign->id) }}" class="btn btn-sm btn-dark" title="View Campaign Order Report"><i class="fa fa-eye"></i></a></td>
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
