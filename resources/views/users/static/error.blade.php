@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
@endsection
