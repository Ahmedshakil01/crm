@extends('frontend.layouts.app')

@section('title', 'Sorry!')


@section('content')
    <div id="sorry">
        <div class="container">
            <div class="row sorry-content">
                <div class="col-md-4 col-12">
                    <img src="{{ asset('assets/frontend/media/img/sorry/sad-sleepy-emoticon-face-square@2x.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-8 col-12">
                    <h1>Sorry</h1>
                    <h4>We couldn't find that page</h4>
                    <a href="{{ URL::previous() }}" style="margin-right:50px;"><i class="fa fa-angle-double-left"></i> Please go back</a>
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Homepage </a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    @parent

@endsection
