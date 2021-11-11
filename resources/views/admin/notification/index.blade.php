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
                            <h3 class="page-title">View Email List</h3>
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
                            <li class="breadcrumb-item active">Email List</li>
                        </ol>
                    </div>
                    @if($permission->can('notification.approval') || $permission->can('notification.delete') || $permission->can('notification.create'))
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                        @if($permission->can('notification.delete'))
                        <li class=""><a  href="javascript:void()" onclick="deletedata('masterdelete','notifications');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a></li>
                        @endif
                        @if($permission->can('notification.create'))
                            <li class=""><a  href="{{ route('admin.create.notification') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Send New Email</a></li>
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
                                @if($permission->can('notification.approval') || $permission->can('notification.delete'))
                                <th width="5%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                @endif
                                <th width="30%">To </th>
                                <th width="18%">From</th>
                                <th width="17%">Subject</th>
                                <th width="20%">Template</th>
                                <th width="25%">Date Time</th>
                                @if($permission->can('notification.edit') || $permission->can('notification.delete'))
                                <th width="10%" align="right">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach($notifications as $notification)
                                <?php $i++;
                                if($notification->status!="" && $notification->status==1){
                                    $statusdis = '<span style="background:#006600; padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:12px;text-align:center">
                    <i class="fa fa-check"></i> </span>';
                                }
                                else{
                                    $statusdis = '<span style="background:#D91021; padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:12px;text-align:center">
                    <i class="fa fa-times"></i> </span>';
                                }
                                ?>

                                <tr id="tablerow<?php echo $notification->id;?>" class="tablerow">
                                    @if($permission->can('notification.approval') || $permission->can('notification.delete'))
                                    <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $notification->id }}" /></td>
                                    @endif
                                    @php
                                        $customerId=explode(",",$notification->user_id);
                                        $customers=DB::table('customers')->whereIn('id',  $customerId)->get();
                                        $arrayLength=count($customers);    
                                    @endphp
                                    <td align="center" width="30%" valign="top">
                                        @foreach ($customers as $key=> $customer)
                                        {{ $customer->name .', '}}
                                        @endforeach
                                    </td>
                                    <td align="center" width="18%" valign="top">{{ $notification->sender->fullname }}</td>
                                    @if ( $notification->subject !="")
                                    <td align="center" valign="top">{{ $notification->subject }}</td>
                                        @else
                                        <td align="center" valign="top"></td>
                                    @endif
                                    <td align="center" valign="top">{{  $notification->TemplateType->name  }}</td>
                                    <td align="center" width="25%" valign="top">{{ $notification->created_at }}</td>
                                    @if($permission->can('notification.delete'))
                                    <td align="center" width="10%" valign="top">
                                    @if($permission->can('notification.delete'))
                                        <div style="width:20%; float:left">
                                            <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px" onclick="deleteSingle('<?php echo $notification->id;?>','/administration/masterdelete','notifications')"><i class="fa fa-trash"></i></button>
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
