@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<div class="row">
    <div class="col text-center text-warning">
        <i class="fas fa-car-crash tada animated infinite fa-10x"></i>
        <div class="clearfix"></div>
        <span class="spinner-border"></span>
        <h2 class="p-2">
            {{ session('note', 'Something went wrong') }}
        </h2>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <a class="btn btn-outline-primary btn-lg" role="button" href="{{ session('link', route('index')) }}">
            <span>
                <i class="fas fa-arrow-left"></i>
            </span>
            <span>Go Back to Safety</span>
        </a>
    </div>
</div>
@endsection
