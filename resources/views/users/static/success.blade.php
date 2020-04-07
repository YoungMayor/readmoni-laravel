@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<div class="row">
    <div class="col text-center text-success">
        <i class="far fa-check-circle fa-10x"></i>
        <h2 class="p-2">
            {{ session('note', 'Task was successful') }}
        </h2>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <a class="btn btn-outline-success btn-lg" role="button" href="{{ session('link', route('index')) }}">
            <span>Proceed</span>
            <span>
                <i class="fas fa-chevron-right"></i>
            </span>
        </a>
    </div>
</div>
@endsection
