@extends('admin.include.master')
@section('title') Notification Template List - aleshamart @endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="page-header" style="border:none">
                            <h3 class="page-title">View Notification Template</h3>
                        </div>
                      
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Notification Type List</li>
                        </ol>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                           
                            <li class=""><a  href="javascript:void()" onclick="deletedata('/administration/masterdelete','sms_notification_templates');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
                            <li class=""><a  href="{{ route('create.sms-notification.template') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Notification Template</a></li>
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
                        <span class="badge badge-pill badge-secondary">{{ count($notificationTemplates) }}</span>
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
                                <th width="40%">Type Name </th>
                                <th width="40%">Template Name </th>
                                <th width="10%" align="right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  $i=0; ?>
                            @foreach($notificationTemplates as $notificationTemplate)
                                <?php $i++;
                              
                               
                                ?>
                                <tr id="tablerow<?php echo $notificationTemplate->id;?>" class="tablerow">
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $notificationTemplate->id }}" /></td>
                                        @php
                                            // dd($notificationTemplate->NotificationsType);
                                        @endphp
                                    <td align="center" valign="top">{{ $notificationTemplate->notificationsTypes->name }}</td>
                                    <td align="center" valign="top">{{ $notificationTemplate->message }}</td>
                                   
                                    <td align="center" valign="top">
                                        <div style="width:50%; float:left">
                                            <a href="{{ route('sms-notification.template.edit', $notificationTemplate->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a></div>
                                        <div style="width:50%; float:left"><button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px" onclick="deleteSingle('<?php echo $notificationTemplate->id;?>','/administration/masterdelete','sms_notification_templates')"><i class="fa fa-trash"></i></button></div>
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

