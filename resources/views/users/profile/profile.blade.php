@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")
@css(profile)
@endsection

@section("page-js")

@endsection

@section("page-body")

<div class="row">
    <div class="col-10 m-auto m-320">
        <div class="border rounded-circle" id="avatar-preview" style="background-image: url('{{ RM::avatar() }}');"></div>
    </div>
    <div class="w-100"></div>
</div>

@include('incs.profile.basic')

@include('incs.bank.details', [
    'show_verify_note' => true
])


<div class="row mt-5">
    <div class="col-12 p-3">
        <a class="btn btn-success btn-block" role="button" href="{{ route('user.profile.edit.page') }}">Edit Profile</a>
    </div>

    <div class="col-12 p-3">
        <a class="btn btn-warning btn-block" role="button" href="#">Change Password</a>
    </div>
</div>

@endsection
