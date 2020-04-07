@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<div class="row">
    <div class="col text-center text-success">
        <i class="fas fa-user-check fa-10x"></i>
        <div class="clearfix"></div>
        <h2 class="p-2">Account Activation Successful</h2>
    </div>
</div>
<div class="row">
    <div class="col">
        <p>
            Congratlations {{ $name }},
            <br>
            Your Account has been activated. Your Account Key is
            <strong>{{ $key }}.</strong>
            <br>
            Refer others to ReadMONI using that Key and earn extra bonus.
            <br>
            Now you can start
            reading and getting paid. But first click below to finish your profile set-up
            <br>
        </p>
        <a class="btn btn-outline-success btn-block btn-lg" role="button" href="{{ route('user.profile.edit.page') }}">
            <span>
                <i class="fas fa-pen-alt"></i>
            </span>
            <span>To Profile Setup</span>
        </a>
    </div>
</div>
@endsection
