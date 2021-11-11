@extends('admin.include.master')
@section('title') Notification User Type List - aleshamart @endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="page-header" style="border:none">
                            <h3 class="page-title">View Notification List</h3>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>STATUS: </strong> {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">User Type List</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a  href="javascript:void()" onclick="permissions('news','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a></li>
                            <li class=""><a  href="javascript:void()" onclick="permissions('news','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a></li>
                            <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','news');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
                            <li class=""><a  href="{{ route('notification.user.type.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New User Type</a></li>
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
                        <span class="badge badge-pill badge-secondary">{{ count($allnews) }}</span>
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
                                <th width="15%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                <th width="40%">Name </th>
                                <th width="30%">Status</th>
                                <th width="10%" align="right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($allnews as $news)
                                <tr id="tablerow<?php echo $news->id;?>" class="tablerow">
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $news->id }}" /></td>
                                    {{-- <td align="center" valign="top"><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $news->id }}" /></td> --}}
                                    <td align="center" valign="top">{{ $news->name }}</td>
                                    <td><b>@if($news->status == 1) <button class="btn btn-success">Active</button> @else <button class="btn btn-warning">Inactive</button>  @endif</td>
                                    <td align="center" valign="top">
                                        <div style="width:50%; float:left">
                                            <a href="{{ route('notification.user.type.edit', $news->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a></div>
                                        <div style="width:50%; float:left"><button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px" onclick="deleteSingle('<?php echo $news->id;?>','masterdelete','users_types')"><i class="fa fa-trash"></i></button></div>
                                    </td>
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


