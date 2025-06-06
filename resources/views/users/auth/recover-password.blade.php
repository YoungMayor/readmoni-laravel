@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")

<!-- Start: Forgotten Password Form -->
<div class="card shadow-lg o-hidden border-0 my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-flex">
                <div class="flex-grow-1 bg-password-image" style="background-image: url(&quot;assets/img/dogs/image1.jpeg?h=430aabda8f7926f94f558f54049fc6e6&quot;);"></div>
            </div>
            <div class="col-lg-6">
                <div class="p-5">
                    <div class="text-center">
                        <h4 class="text-dark mb-2">Forgot Your Password?</h4>
                        <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                    </div>
                    <form class="user">
                        <div class="form-group">
                            <input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                        </div>
                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">Reset Password</button>
                    </form>
                    <div class="text-center">
                        <hr>
                        <a class="small" href="recover-password.html">Create an Account!</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="login.html">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End: Forgotten Password Form -->

@endsection
