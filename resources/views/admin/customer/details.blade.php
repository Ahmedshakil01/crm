@extends('admin.include.master')
 @section('title') Customer Details - Aleshamart @endsection
@section('content')
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
              <h3 class="page-title">Customer Detail Information</h3>
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
                  <li class="breadcrumb-item active">Customer : {{ $customer->name }}</li>
              </ol>
          </div>
          <div class="col-sm-12">

            <ol class="breadcrumb float-sm-right">
               <li class=""><a  href="{{ route('customer.index') }}" style="color: #fff; margin-right:20px" class="btn btn-info btn-sm"><i class="fa fa-list"></i> View Customer List</a></li>
                <li><a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a></li>

            </ol>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Profile Details </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <tbody>

                <tr>
                  <th scope="row" class="">Name :</th>
                  <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                <tr>
                  <th scope="row" class="">Contact :</th>
                  <td>{{ $customer->phone }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Email :</th>
                  <td>{{ $customer->email }}</td>
                </tr>
                <tr>
                    <th scope="row" class="">Date of Birth :</th>
                    <td>{{ $customer->dob }}</td>
                </tr>
                <tr>
                    <th scope="row" class="">Gender :</th>
                    <td>{{ $customer->gender }}</td>
                </tr>
                <tr>
                    <th scope="row" class="">Source Type :</th>
                    <td>{{ $customer->source }}</td>
                </tr>
                <tr>
                    <th scope="row" class="">Status :</th>
                    <td>
                        <label class="label btn-sm btn-success">{{ $customer->status }}</label>
                    </td>
                </tr>

                <tr>
                  <th scope="row" class="">Created_at :</th>
                  <td>{{ $customer->created_at }}</td>
                </tr>
                <tr>
                  <th scope="row" class="">Updated_at :</th>
                  <td>{{ $customer->updated_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Address Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th scope="row">District</th>
                            <th scope="row">Area</th>
                            <th scope="row">Address</th>
                            <th scope="row">Address Type</th>
                            <th scope="row">Created At</th>
                            <th scope="row">Updated At</th>
                        </tr>
                        <tbody>
                        @php($i=1)
                        @foreach($addresses as $address)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $address->district->title }}</td>
                                <td>{{ $address->area->title }}</td>
                                <td>{{ $address->address }}</td>
                                <td>{{ $address->address_type }}</td>
                                <td>{{ $address->created_at }}</td>
                                <td>{{ $address->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
        </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Customer Order Summary</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped table-bordered">
              <tbody>
                  <td></td>
                  <td><strong>Count</strong></td>
                  <td><strong>Amount (TK)</strong></td>
                  @foreach ($order_blocks as $oblock)
                      <tr>
                          <th scope="row" class="">{{ $oblock['title'] }}</th>
                          <td>{{ $oblock['number'] }}</td>
                          <td>Tk. {{number_format( $oblock['amount'] , 2)}}</td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>

      <!-- /.col -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customer Transaction Summary</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped table-bordered">
                        <tbody>
                        <td></td>
                        <td><strong>Count</strong></td>
                        <td><strong>Amount (TK)</strong></td>
                        @foreach ($transaction_blocks as $tblock)
                            <tr>
                                <th scope="row" class="">{{ $tblock['title'] }}</th>
                                <td>{{ $tblock['number'] }}</td>
                                <td>Tk. {{number_format( $tblock['amount'] , 2)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
        </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
</div>

@endsection
