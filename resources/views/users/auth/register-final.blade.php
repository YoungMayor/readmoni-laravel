@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<form action="paystack_pay" method="post">
    <h3 class="text-center">Registration Successful</h3>
    <div class="form-group">
        <small class="form-text text-center text-muted">
            You will be redirected to PayStack whre your onetime non-refundable payment of N2,600 would be made. <br>
            <br>
            Click "<strong>Pay Now</strong>
            " below to proceed to payment
        </small>
    </div>
    <div class="form-group">
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
