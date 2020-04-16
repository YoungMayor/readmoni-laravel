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
                <div class="flex-grow-1 bg-login-image"
                    style="background-image: url(&quot;assets/img/background.jpg?h=d75895f87214c01baf417f87ab6a932e&quot;);">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-5">
                    <div class="text-center">
                        <h4 class="text-dark mb-4">Account Recovery Completed. Create a new Password below</h4>
                    </div>
                    <form class="user">
                        <div class="form-group"><input class="form-control form-control-user" type="email"
                                id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..."
                                name="email"></div>
                        <div class="form-group"><input class="form-control form-control-user" type="password"
                                id="password" placeholder="Password..." name="password"></div>
                        <div class="form-group"><input class="form-control form-control-user" type="password"
                                id="password_confirmation" placeholder="Re-enter password" name="password_confirmation">
                        </div><button class="btn btn-primary btn-block text-white btn-user" type="submit">Update
                            Password</button>
                        <hr>
                    </form>
                    <div class="text-center"><a class="small" href="register-first.html">Create an Account!</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
