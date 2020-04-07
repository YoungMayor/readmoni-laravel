@extends('layouts.user')

@section("title", "ReadMONI - Login")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<!-- Start: Login Form -->
<div class="card shadow-lg o-hidden border-0 my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-flex">
                <div class="flex-grow-1 bg-login-image" style="background-image: url('@imgURL(background.jpg)');"></div>
            </div>
            
            <div class="col-lg-6">
                <div class="p-5">
                    <div class="text-center">
                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                    </div>
                    <form class="userx" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <input class="form-control form-control-user @error('email') is-invalid @enderror" type="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="{{ old('email') }}" autocomplete="email" autofocus name="email" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <input class="form-control form-control-user @error('password') is-invalid @enderror" type="password" id="password" placeholder="Password" name="password" autocomplete="current-password" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">
                            Login
                        </button>
                        <hr>
                    </form>

                    <div class="text-center">
                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>

                    <div class="text-center">
                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End: Login Form -->
@endsection
