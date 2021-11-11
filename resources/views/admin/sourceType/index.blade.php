
@extends('admin.include.master')
@section('title') Notification Type List - aleshamart @endsection
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
                            <h3 class="page-title">View Source Type List</h3>
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
                            <li class="breadcrumb-item active">Source Type List</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">

{{--
                            <li class=""><a  href="javascript:void()" onclick="deletedata('/administration/masterdelete','sms_notifications_types');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
--}}                       @if($permission->can('news.create'))
                            <li class=""><a  href="{{ route('sourceType.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Source Type</a></li>
                               @endif
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
                        <span class="badge badge-pill badge-secondary">{{ count($sourceTypes) }}</span>
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
                                <th width="15%">ID</th>
                                <th width="40%">Type Name </th>
                                <th width="10%" align="right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($sourceTypes as $sourceType)
                                <?php $i++;


                                ?>
                                <tr id="tablerow<?php echo $sourceType->id;?>" class="tablerow">
                                    <td>{{ $sourceType->id }}</td>
                                    <td align="center" valign="top">{{ $sourceType->name }}</td>
                                    @if($permission->can('admin.edit') || $permission->can('admin.delete'))
                                        <td align="right">
                                            <div class="btn-group" role="group">
                                                @if($permission->can('admin.edit'))
                                                    <a href="{{ route('sourceType.edit', $sourceType->id) }}" class="btn btn-sm btn-warning" style="font-size: 18px; float:left; padding:3px 10px; margin-right:5px;"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if($permission->can('admin.delete'))

                                                    <a href="#deleteModal{{ $sourceType->id }}" data-toggle="modal" class="btn btn-danger" style="font-size: 18px; float:left; padding:3px 10px;"> <i class="fa fa-trash"></i></a>
                                                    <!--Delete Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $sourceType->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">

                                                                </div>
                                                                <div class="modal-body" style="text-align: center">
                                                                    <h4><b>Are you sure?</b></h4>
                                                                    <p>Do you want to Delete Selected data !</p>
                                                                    <form action="{!! route('sourceType.destroy', $sourceType->id) !!}" method="post">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-danger">OK, Delete it</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    </form>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                        </td>
                                    @endif

                                    {{--<td align="center" valign="top">
                                        <div style="width:50%; float:left">
                                            <a href="{{ route('sourceType.edit', $sourceType->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a></div>
                                        <div style="width:50%; float:left"><button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px" onclick="deleteSingle('<?php echo $sourceType->id;?>','/administration/masterdelete','sms_notifications_types')"><i class="fa fa-trash"></i></button></div>
                                    </td>--}}
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

