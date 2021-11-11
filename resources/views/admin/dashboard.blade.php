@extends('admin.include.master')

@section('content')
<?php
  $permission = Auth::guard('administration')->user();
?>
<style>
  .info-box {
    background-color: #d0cbcb;
  }
</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1">
                      {{-- <i class="fa fa-users" aria-hidden="true"></i> --}}
                      <i class="fa fa-users"></i>
                    </span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Customer</span>
                      <span class="info-box-number">
                        {{ $totalCustomer }}
                      @if($permission->can('customer.view'))
                        <a href="{{ route('customer.index') }}" class="small-box-footer" style="float:right;color: #dc5202!important;">More info <i class="fas fa-arrow-circle-right" style="color: #dc5202!important;"></i></a>
                      @endif
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                  <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1">
                      <i class="fa fa-users"></i>
                    </span>
      
                    <div class="info-box-content">
                      <span class="info-box-text">Active Customer</span>
                      <span class="info-box-number">
                        {{ $totalActiveCustomer }}
                      @if($permission->can('customer.view'))
                        <a href="{{ route('customer.index',['status'=>1]) }}" class="small-box-footer" style="float:right;color: #dc5202!important;">More info <i class="fas fa-arrow-circle-right" style="color: #dc5202!important;"></i></a>
                      @endif
                      </span>
                    </div>
                  </div>
                </div>
              </div>
                
            </div>
        </section>
    </div>
@endsection
