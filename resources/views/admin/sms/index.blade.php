@extends('admin.include.master')
@section('title') Notification List - Aleshamart @endsection
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
                            <h3 class="page-title">View Notification List</h3>
                        </div>
                      
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Settings</li>
                            <li class="breadcrumb-item active">Notification List</li>
                        </ol>
                    </div>
                    @if($permission->can('notification.approval') || $permission->can('notification.delete') || $permission->can('notification.create'))
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                       
                        @if($permission->can('notification.create'))
                            <li class=""><a  href="{{ route('admin.create.sms-notification') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Notification</a></li>
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
                        <span class="badge badge-pill badge-secondary">{{ count($notifications) }}</span>
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
                                
                                <th width="10%">Type </th>
                                <th width="25%">Message Body </th>
                                <th width="40%">Receiver </th>
                                <th width="15%">Sender </th>
                                <th width="10%">Date </th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $i=0; 
                            
                            ?>
                            @foreach($notifications as $notification)
                                <?php $i++;
                               
                                ?>

                                <tr id="tablerow<?php echo $notification->id;?>" class="tablerow">
                                   
                                  
                                    <td align="center" valign="top">{{ $notification->notificationTypes->name }}</td>
                                    <td align="center" valign="top">{!! $notification->details !!}</td>
                                    <td align="center" valign="top"> 
                                        @if ($notification->sms_type =="All")
                                                {{$notification->sms_type}}
                                        @else
                                            @php
                                            $customerId=explode(",",$notification->customer_id);
                                            $customers=DB::table('customers')->whereIn('id',  $customerId)->get();
                                            $arrayLength=count($customers);
                                        
                                            @endphp

                                            @foreach ($customers as $key=> $customer)
                                                <a class="btn btn-default" href="{{ route('admin.customer.details', $customer->id) }}" style="padding: 2px 5px; margin: 2px;"> {{ $customer->name . ' '}} </a>        
                                            @endforeach
                                        @endif
                                        @php
                                            $senderName=DB::table('administrations')->where('id',  $notification->sender_id)->select('fullname')->first();
                                            
                                        @endphp
                                        <td align="center" valign="top">{{ $senderName->fullname }}</td>
                                        <td align="center" valign="top">{{ date('d-M-Y', strtotime($notification->created_at)); }}</td>
                                     
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
