@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")

<div class="row">
    <div class="col text-center text-warning">
        <i class="fas fa-user-lock fa-10x"></i>
        <div class="clearfix"></div>
        <span class="bg-danger border rounded-circle border-success spinner-grow mt-2"></span>
        <span class="shadow spinner-grow mt-2"></span>
        <span class="bg-success border rounded-circle border-danger spinner-grow mt-2"></span>
        <h2 class="p-2">
            Keeping you secured is out top priority.<br>We urge you to verify your email address with the link we sent to you.
        </h2>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <p class="text-black-50 m-0 small">
            If you are sure you did not receive any email. Then click below to get another verification mail
        </p>

        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf

            <button class="btn btn-outline-primary btn-lg" type="submit">
                <span>
                    <i class="fas fa-envelope-open-text"></i>
                </span>
                <span>Resend Verification Link</span>
            </button>
        </form>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                <span>
                    <strong>
                        A fresh verification link has just been sent to your email address
                    </strong>
                </span>
            </div>
        @endif
    </div>
</div>

@endsection
