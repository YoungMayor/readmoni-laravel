@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<!-- Start: Registration Form -->
<div class="card shadow-lg o-hidden border-0 my-5">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-lg-5 d-none d-lg-flex">
                <div class="flex-grow-1 bg-register-image" style="background-image: url('@imgURL(background.jpg)');"></div>
            </div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h4 class="text-dark mb-4">Create an Account!</h4>
                    </div>
                    
                    <form class="userx" action="{{ route('register') }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input class="form-control form-control-user @error('full_name') is-invalid @else is-valid @enderror" type="text" id="full_name" placeholder="Full Name" name="full_name" required="" value="{{ old('full_name') }}">
                                <small>
                                    <small>
                                        <em>Your Real Name. This will not be disclosed to other users but is needed for payment validations</em>
                                    </small>
                                    @error('full_name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </small>
                            </div>

                            <div class="col-sm-6">
                                <input class="form-control form-control-user @error('chat_name') is-invalid @else is-valid @enderror" type="text" id="chat_name" placeholder="Chat Name" name="chat_name" required="" value="{{ old('chat_name') }}">
                                <small>
                                    <small>
                                        <em>Create a unique chat name, this will be shown to other users.</em>
                                        <br>
                                        <em>Only Alphabets, numerals, fullstop, comma and underscore are allowed. No space allowed</em>
                                        <br>
                                    </small>
                                    @error('chat_name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </small>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea id="address" class="border rounded form-control @error('address') is-invalid @else is-valid @enderror" name="address" placeholder="Home Address. Example: Street Number, Street Name, Region/Town, State" rows="3" required="">{{ old('address') }}</textarea>
                            @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input class="form-control form-control-user @error('telephone') is-invalid @else is-valid @enderror" type="tel" id="telephone" placeholder="Telephone Number" name="telephone" required="" value="{{ old('telephone') }}">
                                <small>
                                    <small>
                                        <em>Your phone number would be used for confirmation calls and transaction alerts. It will not be disclosed to other users</em>
                                    </small>
                                    @error('telephone')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </small>
                            </div>

                            <div class="col-sm-6">
                                <input class="form-control form-control-user @error('email') is-invalid @else is-valid @enderror" type="email" id="email" aria-describedby="emailHelp" placeholder="Email Address" name="email" required="" value="{{ old('email') }}">
                                <small>
                                    <small>
                                        <em>
                                            Your E-mail address would be used for login and password recovery
                                        </em>
                                    </small>
                                    @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-7 mb-3 mb-sm-0">
                                <input id="dob" class="form-control @error('dob') is-invalid @else is-valid @enderror" type="date" name="dob" value="1960-05-10" max="2004-03-30" required="" value="{{ old('dob') }}">
                                <small>
                                    <small>
                                        <em>Your Date of Birth</em>
                                    </small>
                                    @error('dob')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </small>
                            </div>

                            <div class="col-sm-5">
                                <label class="d-block">
                                    Sex: 
                                </label>
                                {!! RM::genderSelect(old('gender')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input class="form-control form-control-user @error('password') is-invalid @else is-valid @enderror" type="password" id="password" placeholder="Password" name="password" required="" value="{{ old('password') }}">
                                @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control form-control-user" type="password" id="password_confirmation" placeholder="Repeat Password" name="password_confirmation" required="" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input class="form-control form-control-user @error('referer') is-invalid @else is-valid @enderror" type="text" id="referer" placeholder="Your referer" name="referer" value="{{ old('referer') }}" pattern="^[A-z]{2}-[0-9]{4}[A-z]$">
                                <small>
                                    <small>
                                        <em>
                                            If you were refered by a friend. Enter his Account Key here. Or leave blank if you were not refered by anyone
                                        </em>
                                    </small>
                                    @error('referer')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </small>
                            </div>

                            <div class="col-sm-6">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="tnc" name="tnc" value="1" required="">
                                    <label class="custom-control-label" for="tnc">
                                        <small>
                                            <em>
                                                I have read and accepted the 
                                                <a href="{{ route("user.terms.page") }}"> Terms and Condition </a>
                                                of Use. And I understand all that is required of me
                                            </em>
                                        </small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex">
                                <div>
                                    <span class="text-danger">
                                        <i class="fa fa-warning fa-2x"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <small class="form-text text-muted">
                                        After a successful registration of your account. You would be required to make a non-refundable onetime payment of N{{ number_format(config('app.REGISTRATION_FEE')) }} using 
                                        <a href="{{ config('app.PAYSTACK_URL') }}">Paystack</a>
                                        before your account will be duly activated.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block text-white btn-user" type="submit">Register Account</button>
                        </div>
                        <hr>
                    </form>

                    <div class="text-center">
                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>

                    <div class="text-center">
                        <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End: Registration Form -->
@endsection
