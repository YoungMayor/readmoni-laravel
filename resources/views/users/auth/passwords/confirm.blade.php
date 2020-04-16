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
                        <h4 class="text-dark mb-4">Account verification needed</h4>
                        <small class="form-text text-muted">
                            1, 2, 3, oh please pardon us.<br>We're just performing a simple account verification test to ensure this account has not been hijacked. Enter your password to proceed
                        </small>
                    </div>

                    <form class="userx" method="POST" action="{{ route('password.confirm') }}">
                        @csrf 

                        <div class="form-group">
                            <input class="form-control form-control-user @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="Password..." autofocus="" required="">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn btn-primary btn-block text-white btn-user" type="submit">
                            Confirm Password
                        </button>
                        <hr>
                    </form>

                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="small" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
