@extends('admin.include.master')
@section('title') Campaign Details - Aleshamart @endsection
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
                            <h3 class="page-title">Campaign Title : {{ $campaign->title ?? ''}}</h3>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Sales Module</li>
                            <li class="breadcrumb-item">Campaign</li>
                            <li class="breadcrumb-item">Campaign List</li>
                            <li class="breadcrumb-item active">Campaign Title : {{ $campaign->title ?? '' }}</li>
                        </ol>
                    </div>
                    <div class="col-sm-12 mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm"><i class="fas fa-arrow-circle-left"></i> Back</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
{{--                    Campaign Summary--}}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Campaign Summary</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                    @foreach ($campaign_blocks as $block)
                                        <tr>
                                            <th scope="row" class="">{{ $block['title'] }}</th>
                                            <td>{{ $block['number'] }}</td>
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

{{--                    Campaign Order Summary--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Campaign Order Summary</h3>
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

{{--                    Campaign Transaction Summary--}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Campaign Transaction Summary</h3>
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
