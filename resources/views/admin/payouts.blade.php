@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0">Payout Requests</h3>
</div>
<!-- Start: Account Summary -->
<div class="row">
    <div class="col">
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <td>Account Balance</td>
                        <td class="text-right">N192,000.00</td>
                    </tr>
                    <tr>
                        <td>User Funds</td>
                        <td class="text-right">N120,000.00</td>
                    </tr>
                    <tr>
                        <td>Profit/Loss</td>
                        <td class="table-success text-right">N72,000.00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Pending Payouts</td>
                        <td>17</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End: Account Summary -->
<!-- Start: Payout List -->
<div id="payout_requests">
    <div class="border rounded shadow-lg" id="pay_selected_users_block">
        <!-- Start: Split Button Success --><a class="btn btn-success btn-icon-split" role="button" id="pay_selected_users"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay Selected Users</span></a>
        <!-- End: Split Button Success -->
    </div>
    <!-- Start: Payout -->
    <div class="row align-items-center border-bottom pb-2 pt-2">
        <div class="col">
            <div class="custom-control custom-checkbox"><input class="custom-control-input mass_payout" type="checkbox" id="user-1" value="1" name="mass_payout"><label class="custom-control-label" for="user-1">AB-1234C <strong>Meyoron Aghogho Happiness</strong></label></div>
        </div>
        <div class="col-auto"><span>N4,000</span></div>
        <div class="col-auto">
            <div class="btn-group" role="group"><a class="btn btn-outline-info btn-sm mr-2" role="button" href="audit.html" target="_blank">Audit</a>
                <!-- Start: Split Button Success --><a class="btn btn-success btn-sm btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay</span></a>
                <!-- End: Split Button Success -->
            </div>
        </div>
    </div>
    <!-- End: Payout -->
    <!-- Start: Payout -->
    <div class="row align-items-center border-bottom pb-2 pt-2">
        <div class="col">
            <div class="custom-control custom-checkbox"><input class="custom-control-input mass_payout" type="checkbox" id="user-1" value="1" name="mass_payout"><label class="custom-control-label" for="user-1">AB-1234C <strong>Meyoron Aghogho Happiness</strong></label></div>
        </div>
        <div class="col-auto"><span>N4,000</span></div>
        <div class="col-auto">
            <div class="btn-group" role="group"><a class="btn btn-outline-info btn-sm mr-2" role="button" href="audit.html" target="_blank">Audit</a>
                <!-- Start: Split Button Success --><a class="btn btn-success btn-sm btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay</span></a>
                <!-- End: Split Button Success -->
            </div>
        </div>
    </div>
    <!-- End: Payout -->
    <!-- Start: Payout -->
    <div class="row align-items-center border-bottom pb-2 pt-2">
        <div class="col">
            <div class="custom-control custom-checkbox"><input class="custom-control-input mass_payout" type="checkbox" id="user-1" value="1" name="mass_payout"><label class="custom-control-label" for="user-1">AB-1234C <strong>Meyoron Aghogho Happiness</strong></label></div>
        </div>
        <div class="col-auto"><span>N4,000</span></div>
        <div class="col-auto">
            <div class="btn-group" role="group"><a class="btn btn-outline-info btn-sm mr-2" role="button" href="audit.html" target="_blank">Audit</a>
                <!-- Start: Split Button Success --><a class="btn btn-success btn-sm btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay</span></a>
                <!-- End: Split Button Success -->
            </div>
        </div>
    </div>
    <!-- End: Payout -->
    <!-- Start: Payout -->
    <div class="row align-items-center border-bottom pb-2 pt-2">
        <div class="col">
            <div class="custom-control custom-checkbox"><input class="custom-control-input mass_payout" type="checkbox" id="user-1" value="1" name="mass_payout"><label class="custom-control-label" for="user-1">AB-1234C <strong>Meyoron Aghogho Happiness</strong></label></div>
        </div>
        <div class="col-auto"><span>N4,000</span></div>
        <div class="col-auto">
            <div class="btn-group" role="group"><a class="btn btn-outline-info btn-sm mr-2" role="button" href="audit.html" target="_blank">Audit</a>
                <!-- Start: Split Button Success --><a class="btn btn-success btn-sm btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay</span></a>
                <!-- End: Split Button Success -->
            </div>
        </div>
    </div>
    <!-- End: Payout -->
    <!-- Start: Payout -->
    <div class="row align-items-center border-bottom pb-2 pt-2">
        <div class="col">
            <div class="custom-control custom-checkbox"><input class="custom-control-input mass_payout" type="checkbox" id="user-1" value="1" name="mass_payout"><label class="custom-control-label" for="user-1">AB-1234C <strong>Meyoron Aghogho Happiness</strong></label></div>
        </div>
        <div class="col-auto"><span>N4,000</span></div>
        <div class="col-auto">
            <div class="btn-group" role="group"><a class="btn btn-outline-info btn-sm mr-2" role="button" href="audit.html" target="_blank">Audit</a>
                <!-- Start: Split Button Success --><a class="btn btn-success btn-sm btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay</span></a>
                <!-- End: Split Button Success -->
            </div>
        </div>
    </div>
    <!-- End: Payout -->
    <!-- Start: Payout -->
    <div class="row align-items-center border-bottom pb-2 pt-2">
        <div class="col">
            <div class="custom-control custom-checkbox"><input class="custom-control-input mass_payout" type="checkbox" id="user-1" value="1" name="mass_payout"><label class="custom-control-label" for="user-1">AB-1234C <strong>Meyoron Aghogho Happiness</strong></label></div>
        </div>
        <div class="col-auto"><span>N4,000</span></div>
        <div class="col-auto">
            <div class="btn-group" role="group"><a class="btn btn-outline-info btn-sm mr-2" role="button" href="audit.html" target="_blank">Audit</a>
                <!-- Start: Split Button Success --><a class="btn btn-success btn-sm btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay</span></a>
                <!-- End: Split Button Success -->
            </div>
        </div>
    </div>
    <!-- End: Payout -->
    <!-- Start: Payout -->
    <div class="row align-items-center border-bottom pb-2 pt-2">
        <div class="col">
            <div class="custom-control custom-checkbox"><input class="custom-control-input mass_payout" type="checkbox" id="user-1" value="1" name="mass_payout"><label class="custom-control-label" for="user-1">AB-1234C <strong>Meyoron Aghogho Happiness</strong></label></div>
        </div>
        <div class="col-auto"><span>N4,000</span></div>
        <div class="col-auto">
            <div class="btn-group" role="group"><a class="btn btn-outline-info btn-sm mr-2" role="button" href="audit.html" target="_blank">Audit</a>
                <!-- Start: Split Button Success --><a class="btn btn-success btn-sm btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay</span></a>
                <!-- End: Split Button Success -->
            </div>
        </div>
    </div>
    <!-- End: Payout -->
    <!-- Start: Payout -->
    <div class="row align-items-center border-bottom pb-2 pt-2">
        <div class="col">
            <div class="custom-control custom-checkbox"><input class="custom-control-input mass_payout" type="checkbox" id="user-1" value="1" name="mass_payout"><label class="custom-control-label" for="user-1">AB-1234C <strong>Meyoron Aghogho Happiness</strong></label></div>
        </div>
        <div class="col-auto"><span>N4,000</span></div>
        <div class="col-auto">
            <div class="btn-group" role="group"><a class="btn btn-outline-info btn-sm mr-2" role="button" href="audit.html" target="_blank">Audit</a>
                <!-- Start: Split Button Success --><a class="btn btn-success btn-sm btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay</span></a>
                <!-- End: Split Button Success -->
            </div>
        </div>
    </div>
    <!-- End: Payout -->
</div>
<!-- End: Payout List -->
@endsection
