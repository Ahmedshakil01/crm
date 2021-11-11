<?php
$permission = Auth::guard('administration')->user();
?>
<table id="responsive-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th width="8%">ID</th>
        <th width="8%">Total Order</th>
        <th width="8%">Name</th>
        <th width="8%">Email</th>
        <th width="8%">Phone</th>
        {{-- @if($permission->can('customer.edit') || $permission->can('customer.delete') || $permission->can('customer.detail'))
             <th width="6%" align="right">Action</th>
         @endif--}}
    </tr>
    </thead>
    <tbody>
    <?php $i=0; ?>
    @foreach($allcustomer as $customer)
        <?php $i++;?>

        <tr id="tablerow<?php echo $customer->customer_id;?>" class="tablerow">

            <td>{{ $customer->customer_id }}</td>
            <td>{{ $customer->total_order_id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            {{--@if($permission->can('customer.edit') || $permission->can('customer.delete') || $permission->can('customer.detail'))
                <td align="right" class="btn-group">

                    @if($permission->can('customer.detail'))
                        <a href="{{ route('admin.customer.details', $customer->id) }}" class="btn btn-sm btn-info " title="View Order Report" style="font-size: 10px; float:left; padding:6px 10px; margin-right: 5px;"><i class="fa fa-info"></i></a>
                    @endif
                    @if($permission->can('customer.detail'))
                        <a href="{{ route('admin.customer.details', $customer->id) }}" class="btn btn-sm btn-primary" title="Send SMS" style="font-size: 12px; float:left; padding:6px 10px; margin-right: 5px;"><i class="fa fa-paper-plane"></i></a>
                    @endif
                    @if($permission->can('customer.detail'))
                        <a href="{{ route('admin.customer.details', $customer->id) }}" class="btn btn-sm btn-warning" style="font-size: 12px; float:left; padding:6px 10px; margin-right: 5px;" title="Send Email"><i class="fa fa-envelope"></i></a>
                    @endif

                </td>
            @endif--}}
        </tr>
    @endforeach
    </tbody>
</table>
