@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")

<div class="card shadow-lg o-hidden border-0 my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-flex">
                <div class="flex-grow-1 bg-login-image" style="background-image: url('@imgURL(background.jpg)');"></div>
            </div>
            <div class="col-lg-6">
                <div class="p-5">
                    <div class="text-center">
                        <h4 class="text-dark mb-4">Account Recovery Completed. Create a new Password below</h4>
                    </div>

                    <form class="userx" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <input class="form-control form-control-user @error('email') is-invalid @enderror" type="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input class="form-control form-control-user @error('password') is-invalid @enderror" type="password" id="password" placeholder="Password..." name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input class="form-control form-control-user" type="password" id="password_confirmation" placeholder="Re-enter password" name="password_confirmation" required>
                        </div>

                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">
                            Update Password
                        </button>
                        <hr>
                    </form>
                    <div class="text-center">
                        <a class="small" href="{{ route('register') }}">
                            Create an Account!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
