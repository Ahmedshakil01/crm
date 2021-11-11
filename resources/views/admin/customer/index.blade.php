
@extends('admin.include.master')
@section('title') Customer List - Aleshamart @endsection
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
        svg {
            overflow: hidden;
            vertical-align: middle;
            width: 20px !important;
        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div class="page-header" style="border:none;">
                            <h3 class="page-title">View Customer List</h3>
                            <li>
                                <select class="cartBtn"  onchange="ajaxCustomer(this.value);">
                                    <option value="all"> View All </option>
                                    <option value="0_days"> Today </option>
                                    <option value="-1_days"> Last day </option>
                                    <option value="3_days"> Last 3 days </option>
                                    <option value="7_days" selected="selected"> Last 7 days </option>
                                    <option value="15_days"> Last 15 days </option>
                                    <option value="30_days"> Last 30 days </option>
                                    <option value="45_days"> Last 45 days </option>
                                    <option value="60_days"> Last 60 days </option>
                                    <option value="90_days"> Last 90 days </option>
                                    <option value="180_days"> Last 180 days </option>
                                    <option value="365_days"> Last 365 days </option>
                                    <!--<option value="custom"> Custom Date Range </option>-->
                                </select>
                            </li>
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
                            <li class="breadcrumb-item active">Customer List</li>
                        </ol>
                    </div>
                    @if($permission->can('customer.approval') || $permission->can('customer.delete') || $permission->can('customer.create'))
                        <div class="col-sm-12">
                            <ol class="breadcrumb float-sm-right">
                                @if($permission->can('customer.create'))
                                    <li class=""><a  href="{{ route('customer.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Customer</a></li>
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
                        <span class="badge badge-pill badge-secondary"><span id="totalCounts">{{ count($allcustomer) }}</span> </span>
                    </h3>

                    <div class="card-tools">
                        <div id="daysv"></div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="LoadingImageE" style="width:100%; height:auto; text-align:left;display:none;">
                        <img src="{{ asset('assets/images/mainloader.gif')}}" style="width:60px; height:auto; margin:auto" /></div>

                    <form id="form_check">
                        <div id="responsedata">
                            <table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th width="8%">ID</th>
                                    <th width="8%">Name</th>
                                    <th width="8%">Email</th>
                                    <th width="8%">Phone</th>
                                    <th width="8%">Source Type</th>
                                    <th width="8%">DOB</th>
                                    <th width="8%">Gender</th>
                                    <th width="8%">Status</th>
                                    <th width="8%">Created At</th>
                                    <th width="8%">Updated At</th>
                                    @if($permission->can('customer.edit') || $permission->can('customer.delete') || $permission->can('customer.detail'))
                                        <th width="6%" align="right">Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; ?>
                                @foreach($allcustomer as $customer)
                                    <?php $i++;?>

                                    <tr id="tablerow<?php echo $customer->id;?>" class="tablerow">

                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->source }}</td>
                                        <td>{{ $customer->dob }}</td>
                                        <td>{{ $customer->gender }}</td>
                                        <td><span class="label label-success">{{ $customer->status }}</span></td>
                                        <td>{{ $customer->created_at->diffForHumans() }}</td>
                                        <td>{{ $customer->updated_at->diffForHumans() }}</td>

                                        {{--<th width="2%" align="center"><?php echo $statusdis; ?></th>--}}
                                        @if($permission->can('customer.edit') || $permission->can('customer.delete') || $permission->can('customer.detail'))
                                            <td align="right" class="btn-group">

                                                @if($permission->can('customer.detail'))
                                                    <a href="{{ route('admin.customer.details', $customer->id) }}" class="btn btn-sm btn-info " title="View Order Report" style="font-size: 10px; float:left; padding:6px 10px; margin-right: 5px;"><i class="fa fa-info"></i></a>
                                                @endif
                                                @if($permission->can('customer.detail'))
                                                    <a href="{{ route('admin.create.sms-notification', $customer->id) }}" class="btn btn-sm btn-primary" title="Send SMS" style="font-size: 12px; float:left; padding:6px 10px; margin-right: 5px;"><i class="fa fa-paper-plane"></i></a>
                                                @endif
                                                @if($permission->can('customer.detail'))
                                                    <a href="{{ route('admin.create.notification', $customer->id) }}" class="btn btn-sm btn-warning" style="font-size: 12px; float:left; padding:6px 10px; margin-right: 5px;" title="Send Email"><i class="fa fa-envelope"></i></a>
                                                @endif

                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">

                                    {{ $allcustomer->links() }}

                            </div>


                        </div>



                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </div>



@endsection
<script type="text/javascript" src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

<script>
    // $('#responsive-datatable').dataTable({
    //     "paging": false
    // });
    $(document).ready(function() {
        $('#responsive-datatable').DataTable( {
            "paging":   false,
        } );
    } );

    function ajaxCustomer(key)
    {

        var surl = '/administration/customer/ajaxfilter/';
        $.ajax({
            type: "GET",
            url: surl,
            data: {'keys':key},
            cache: false,
            beforeSend: function(){
                $('#LoadingImageE').show();
            },
            complete: function(){
                $('#LoadingImageE').hide();
            },
            success: function(response) {
                //alert(response);
                $('#LoadingImageE').hide();
                //alert(response.totalOCounts);
                $('#responsedata').html(response.viewpages);
                $('#totalCounts').html(response.totalOCounts);
                var operatorval;
                if(response.operators==0){
                    operatorval = 'Today';
                }
                else if(response.operators=='-1'){
                    operatorval = 'Last Day';
                }
                else if(response.operators=='all'){
                    operatorval = 'All Days';
                }
                else{
                    operatorval = 'Last '+response.operators+' Days';
                }
                $('#daysv').html(operatorval);
            },
            error: function (xhr, status) {
                $('#LoadingImageE').hide();
                //alert('Unknown error ' + status);
            }
        });
    }
</script>

