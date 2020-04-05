@extends('layouts.user')

@section("title", "ReadMONI")

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
                    <form class="user">
                        <div class="form-group">
                            <input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password">
                        </div>
                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">Login</button>
                        <hr>
                    </form>
                    <div class="text-center">
                        <a class="small" href="{{ route('user.password.recovery.page') }}">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="{{ route('user.register-first.page') }}">Create an Account!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End: Login Form -->
@endsection
