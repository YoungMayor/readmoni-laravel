@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<form action="{{ route("user.activate.process") }}" method="post">
    @csrf

    <h3 class="text-center">Registration Successful</h3>
    <div class="form-group">
        <small class="form-text text-center text-muted">
            Congratulations <b>{{ $user->full_name }}</b> your account has been successfully created. Your account key is <b>{{ $user->user_key }}</b>
        </small>
        
        <br/>

        <small class="form-text text-center text-muted">
            You will be redirected to <a href="{{ config('app.PAYSTACK_URL') }}">Paystack</a> whre your onetime non-refundable payment of N{{ number_format(config('app.REGISTRATION_FEE')) }} would be made. 
            <br>
            <br>
            Click "<strong>Pay Now</strong>
            " below to proceed to payment
        </small>
    </div>
    <div class="form-group">
        <input type="hidden" name="key" value="{{ $user->user_key }}" />
        <!-- Start: Split Button Success -->
        <button class="btn btn-success btn-lg btn-icon-split m-auto d-block" type="submit">
            <span class="text-white-50 icon">
                <i class="fas fa-dollar-sign"></i>
            </span>
            <span class="text-white text">Pay Now</span>
        </button>
        <!-- End: Split Button Success -->
    </div>
</form>
@endsection
