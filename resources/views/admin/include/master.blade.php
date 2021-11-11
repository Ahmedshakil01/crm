<!DOCTYPE html>
<html lang="en">

@include('admin.include.css')

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Navbar -->
    @include('admin.include.navbar')
    <!-- /.navbar -->
    <!--<div class="container">-->
    <!--    @if ($errors->any())-->
    <!--    <div class="alert alert-danger">-->
    <!--        <button type="button" class="close" data-dismiss="alert">×</button>-->
    <!--        <ul>-->
    <!--            @foreach ($errors->all() as $error)-->
    <!--                <li>{{ $error }}</li>-->
    <!--            @endforeach-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--@endif-->
    <!--@if(session('success'))-->
    <!--    <div class="alert alert-success">-->
    <!--        <button type="button" class="close" data-dismiss="alert">×</button>-->
    <!--        {{ session('success') }}-->
    <!--    </div>-->
    <!--@endif-->
    <!--</div>-->

    <!-- Main Sidebar Container -->
    @include('admin.include.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
    <!-- /.content-wrapper -->

{{--    footer--}}
    @include('admin.include.footer')
    <!-- Control Sidebar -->

    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

{{--js--}}
@include('admin.include.js')
@include('admin.include.notification')
</body>
</html>

