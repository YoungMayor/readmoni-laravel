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
                        <h4 class="text-dark mb-4">Let's get back your account</h4>
                        <small class="form-text text-muted">We understand that stuffs happen, its not you, its the human nature... So lets recover your account for you, just enter your email here.</small>
                    </div>

                    <form class="user" method="POST" action="{{ route('password.email') }}">
                        @csrf 

                        <div class="form-group">
                            <input class="form-control form-control-user @error('email') is-invalid @enderror" type="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" value="{{ old('email') }}" autofocus="" autocomplete="email" required="">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">
                            Send Password Reset Link
                        </button>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <span>{{ session('status') }}</span>
                            </div>
                        @endif

                        <hr>
                    </form>
                    <div class="text-center">
                        <a class="small" href="{{ route('login') }}">
                            Here by mistake? Login
                        </a>
                    </div>

                    <div class="text-center">
                        <a class="small" href="{{ route('login') }}">
                            Create an Account!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
