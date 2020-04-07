@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<div class="row">
    <div class="col text-center text-warning">
        <i class="fas fa-puzzle-piece fa-10x"></i>
        <div class="clearfix"></div>
        <span class="spinner-grow mt-2"></span>
        <h2 class="p-2">
            Oops! <br>The page you requested went on a short break...
        </h2>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <a class="btn btn-outline-primary btn-lg" role="button" href="{{ route('index') }}">
            <span>
                <i class="fas fa-arrow-left"></i>
            </span>
            <span>Go Back to Safety</span>
        </a>
    </div>
</div>
@endsection
