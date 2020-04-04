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
                <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/img/dogs/image2.jpeg?h=a0a7d00bcd8e4f84f4d8ce636a8f94d4&quot;);"></div>
            </div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h4 class="text-dark mb-4">Create an Account!</h4>
                    </div>
                    <form class="user" action="register-final.html" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input class="form-control form-control-user" type="text" id="full_name" placeholder="Full Name" name="full_name" required="">
                                <small>
                                    <small>
                                        <em>Your Real Name. This will not be disclosed to other users but is needed for payment validations</em>
                                    </small>
                                </small>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control form-control-user" type="text" id="chat_name" placeholder="Chat Name" name="chat_name" required="">
                                <small>
                                    <small>
                                        <em>Create a unique chat name, this will be shown to other users.</em>
                                        <br>
                                        <em>Only Alphabets, numerals, fullstop, comma and underscore are allowed. No space allowed</em>
                                        <br>
                                    </small>
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="border rounded form-control" name="home_address" placeholder="Home Address. Example: Street Number, Street Name, Region/Town, State" rows="3" required=""></textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="email" required="">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-7 mb-3 mb-sm-0">
                                <input class="form-control" type="date" name="dob" value="1960-05-10" max="2004-03-30" required="">
                                <small>
                                    <small>
                                        <em>Your Date of Birth</em>
                                    </small>
                                </small>
                            </div>
                            <div class="col-sm-5">
                                <label class="d-block">Sex:</label>
                                <div class="custom-control custom-control-inline custom-radio">
                                    <input class="custom-control-input" type="radio" id="gender_male" name="gender" value="m" required="">
                                    <label class="custom-control-label" for="gender_male">Male</label>
                                </div>
                                <div class="custom-control custom-control-inline custom-radio">
                                    <input class="custom-control-input" type="radio" id="gender_female" name="gender" value="f" required="">
                                    <label class="custom-control-label" for="gender_female">Female</label>
                                </div>
                                <div class="custom-control custom-control-inline custom-radio">
                                    <input class="custom-control-input" type="radio" id="gender_undefined" name="gender" value="u" checked="" required="">
                                    <label class="custom-control-label" for="gender_undefined">Rather not say</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input class="form-control form-control-user" type="password" id="examplePasswordInput" placeholder="Password" name="password" required="">
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control form-control-user" type="password" id="exampleRepeatPasswordInput" placeholder="Repeat Password" name="password_repeat" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input class="form-control form-control-user" type="text" id="user_key" placeholder="Your Account Key" name="user_key" value="AB-1234C" disabled="" readonly="" required="" pattern="([A-z]{2}-[0-9]{4}[A-z])">
                                <small>
                                    <small>
                                        <em>This is automatically generated by the system and can not be modified.</em>
                                    </small>
                                </small>
                            </div>
                            <div class="col-sm-6">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="tnc_accept" name="tnc_accept" value="1" required="">
                                    <label class="custom-control-label" for="tnc_accept">
                                        <small>
                                            <em>I have read and accepted the &nbsp;</em>
                                            <a href="https://bootstrapstudio.io/releases/app/4.5.6/terms.html">
                                                <em>Terms and Condition</em>
                                            </a>
                                            <em>&nbsp;of Use. And I understand all that is required of me</em>
                                            <br>
                                            <br>
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
                                    <small class="form-text text-muted">After a successful registration of your account. You would be required to make a non-refundable onetime payment of N2,600 using Paystack before your account will be duly activated.</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block text-white btn-user" type="submit">Register Account</button>
                        </div>
                        <hr>
                    </form>
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="login.html">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End: Registration Form -->
@endsection
