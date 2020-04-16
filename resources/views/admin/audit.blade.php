@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")

<div>
    <h3>User Audit</h3>
</div>
<div class="row mb-5">
    <div class="col">
        <h5>Basic Profile</h5>
        <div>
            <h2 class="text-uppercase text-center">MEYORON AGHOGHO</h2><span class="text-uppercase text-center d-block">(AB-1234C)</span></div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-2 text-center text-success align-self-center p-1"><i class="far fa-envelope fa-2x"></i></div>
    <div class="col-8 text-break align-self-center"><span>youngmayor08@gmail.com</span></div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-2 text-center text-success align-self-center p-1"><i class="fa fa-phone fa-2x"></i></div>
    <div class="col-8 text-break align-self-center"><span>08075178485</span></div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-2 text-center text-success align-self-center p-1"><i class="far fa-comments fa-2x"></i></div>
    <div class="col-8 text-break align-self-center"><span>young.mayor.32</span></div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-2 text-center text-success align-self-center p-1"><i class="fas fa-home fa-2x"></i></div>
    <div class="col-8 text-break align-self-center"><span>Somewhere in planet earth</span></div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col text-center d-flex justify-content-center align-items-center"><i class="fas fa-calendar-alt fa-2x text-success p-1"></i><span>May 10th, 2020</span></div>
    <div class="col text-center d-flex justify-content-center align-items-center"><i class="fas fa-user-alt fa-2x text-success p-1"></i><span>Male</span></div>
</div>
<div class="row mb-5">
    <div class="col">
        <h5>Banking Details</h5>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Bank Name</td>
                        <td>First Bank Plc.</td>
                    </tr>
                    <tr>
                        <td>Account Name</td>
                        <td>Meyoron Aghogho Happiness</td>
                    </tr>
                    <tr>
                        <td>Account No.</td>
                        <td>121212121012</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col">
        <h5>Payment History</h5>
    </div>
    <div class="col-12">
        <div class="table-responsive table-bordered">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-dark">
                        <th>Date</th>
                        <th>Paid by</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>10-May-20</td>
                        <td>Meyoron Aghogho</td>
                        <td>N19,000</td>
                    </tr>
                    <tr>
                        <td>10-May-20</td>
                        <td>Meyoron Aghogho</td>
                        <td>N19,000</td>
                    </tr>
                    <tr>
                        <td>10-May-20</td>
                        <td>Meyoron Aghogho</td>
                        <td>N19,000</td>
                    </tr>
                    <tr>
                        <td>10-May-20</td>
                        <td>Meyoron Aghogho</td>
                        <td>N19,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Start: Split Button Light --><button class="btn btn-light shadow-sm btn-icon-split m-auto d-block" type="button"><span class="text-black-50 icon"><i class="fas fa-arrow-down"></i></span><span class="text-dark text">Load More Record</span></button>
        <!-- End: Split Button Light -->
    </div>
</div>
<div class="row mb-5">
    <div class="col">
        <h5>Fund Transfer History</h5>
    </div>
    <div class="col-12">
        <div class="table-responsive table-bordered">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-dark">
                        <th>Date</th>
                        <th>User</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-success small">
                        <td>10-May-20</td>
                        <td>AB-1234C Meyoron Aghogho</td>
                        <td>N1,900</td>
                    </tr>
                    <tr class="table-success small">
                        <td>10-May-20</td>
                        <td>AB-1234C Meyoron Aghogho</td>
                        <td>N3,200</td>
                    </tr>
                    <tr class="table-danger small">
                        <td>10-May-20</td>
                        <td>AB-1234C Meyoron Aghogho</td>
                        <td>N1,900</td>
                    </tr>
                    <tr class="table-success small">
                        <td>10-May-20</td>
                        <td>AB-1234C Meyoron Aghogho</td>
                        <td>N3,200</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Start: Split Button Light --><button class="btn btn-light shadow-sm btn-icon-split m-auto d-block" type="button"><span class="text-black-50 icon"><i class="fas fa-arrow-down"></i></span><span class="text-dark text">Load More Record</span></button>
        <!-- End: Split Button Light -->
    </div>
</div>
<div class="row mt-5">
    <div class="col">
        <h4>Balance</h4>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr class="table-dark">
                        <th>Balance</th>
                        <th>Payable</th>
                        <th>Reminant</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-success">N2,890</td>
                        <td class="table-danger">N2,500</td>
                        <td class="text-right">N390</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12 p-3">
        <!-- Start: Split Button Success --><button class="btn btn-success btn-lg btn-icon-split d-block m-auto" type="button"><span class="text-white-50 icon"><i class="fas fa-dollar-sign"></i></span><span class="text-white text">Pay User N2,500</span></button>
        <!-- End: Split Button Success -->
    </div>
    <div class="col-12 p-3 bg-dark text-white rounded shadow-lg">
        <form>
            <h5>Send user a message</h5>
            <div class="form-group"><textarea class="border-info form-control" placeholder="Message for user..." rows="4" required="" spellcheck="true"></textarea></div>
            <div class="form-group"><label class="d-block">Message Type:</label>
                <div class="custom-control custom-control-inline text-success custom-radio"><input class="custom-control-input" type="radio" id="message_type_positive" name="type" value="p" required="" checked=""><label class="custom-control-label btn btn-sm btn-outline-success" for="message_type_positive">Positive</label></div>
                <div
                    class="custom-control custom-control-inline text-danger custom-radio"><input class="custom-control-input" type="radio" id="message_type_negative" name="type" value="n" required=""><label class="custom-control-label btn btn-sm btn-outline-danger" for="message_type_negative">Negative</label></div>
    </div>
    <div class="form-group text-right">
        <!-- Start: Split Button Success --><a class="btn btn-success btn-icon-split" role="button"><span class="text-white-50 icon"><i class="far fa-envelope"></i></span><span class="text-white text">Send Mesage</span></a>
        <!-- End: Split Button Success -->
    </div>
    </form>
</div>

@endsection
