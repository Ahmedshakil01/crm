@extends('admin.include.master')
 @section('title') Contact Details - Aleshamart @endsection
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
              <h3 class="page-title">Contact Detail Information</h3>
              </div>
           
              </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item">Settings</li>
                  <li class="breadcrumb-item active">Contact : {{ $quote_details->company }}</li>
              </ol>
          </div>
          @if($permission->can('news.approval') || $permission->can('news.delete') || $permission->can('news.create'))
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
           
              @if($permission->can('news.create'))
                <li class=""><a  href="{{ route('admin.quote.print', $quote_details->id) }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-lg"><i class="fa fa-print mr-2"></i>Print Quote</a></li>
              @endif
              </ol>
            </div>
          @endif




          <div class="col-sm-12" style="margin:15px;"> 
              <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm">Back</a>
            @if(Auth::guard('administration')->user()->can('news.edit'))  
              <a href="{{ route('contact.edit', $quote_details->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>Edit</a>
            @endif
           
           
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<section class="content">
  <div class="container-fluid">
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">Profile Details </h3>
          </div>
          <div class="card-body">
           <div class="row">
                <div class="col-md-6">
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th scope="row" class="">Status :</th>
                          <td>
                            @if ($quote_details->status == 1)
                              Active
                            @else
                              Deactive
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Quote Owner :</th>
                          <td>{{ $quote_details->quote_owner ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Subject :</th>
                          <td>{{ $quote_details->subject ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Team :</th>
                          <td>{{ $quote_details->team ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Deal Name :</th>
                          <td>{{ $quote_details->deal_name ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class=""> Valid Until :</th>
                          <td>{{ $quote_details->valid_until ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class=""> Contact Id :</th>
                          <td>{{ $quote_details->contact_id ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Billing Street :</th>
                          <td>{{ $quote_details->billing_street ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Billing City :</th>
                          <td>{{ $quote_details->billing_city ?? ' ' }}</td>
                        </tr>

                    </tbody>
                  </table>
                </div>
                <div class="col-md-6">
                  <table class="table table-bordered">
                    <tbody>

                         <tr>
                          <th scope="row" class="">Billing State :</th>
                          <td>{{ $quote_details->billing_state ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Billing Code :</th>
                          <td>{{ $quote_details->billing_code ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Billing Country :</th>
                          <td>{{ $quote_details->billing_country ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping Street :</th>
                          <td>{{ $quote_details->shipping_street ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping City :</th>
                          <td>{{ $quote_details->shipping_city ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping State :</th>
                          <td>{{ $quote_details->shipping_state ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping Code :</th>
                          <td>{{ $quote_details->shipping_code ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping Country :</th>
                          <td>{{ $quote_details->shipping_country ?? ' ' }}</td>
                        </tr>

                        <tr>
                          <th scope="row" class=""> Created At :</th>
                          <td>{{ date('d-M-Y', strtotime($quote_details->created_at)); }}</td>
                        </tr>

                        
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
    </div>

    <h3 class="text-center mt-5   ">Quote Products</h3>
    <div class="container-fluid p-5">
      <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th style="width: 5%;">Sl No</th>
                        <th> Product Name</th>
                        <th> Quantity</th>
                        <th> Price</th>
                        <th> Amount</th>
                        <th> Discount</th>
                        <th> Tax</th>
                        <th> Total</th>
                        <th> Created At</th>
                        <th>Action</th> 
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($quote_details->products as $key=> $products)
                      <tr id="tablerow<?php echo $products->id;?>">
                        <td>{{ $key+1 ?? " "}}</td>
                        <td>{{ $products->product_name ?? " "}}</td> 
                        <td>{{ $products->quantity ?? " "}}</td> 
                        <td>{{ $products->price ?? " "}}</td> 
                        <td>{{ $products->amount ?? " "}}</td> 
                        <td>{{ $products->discount ?? " "}}</td> 
                        <td>{{ $products->tax ?? " "}}</td> 
                        <td>{{ $products->total ?? " "}}</td> 
                        <td>{{ date('d-M-Y', strtotime($products->created_at)); }}</td>
                       <td>
                      
                        @if($permission->can('news.delete'))
                          <button type="button" class="btn btn-sm btn-danger" style="font-size: 12px; padding:6px"
                            onclick="deleteSingle('<?php echo $products->id;?>','/administration/masterdelete','products')"><i class="fa fa-trash"></i></button>
                        @endif

                        
                       </td>
                      </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
      </div>
    </div>



  </div><!-- /.container-fluid -->
</section>
</div>
 
@endsection
