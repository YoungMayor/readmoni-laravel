@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")
@js(ajax-forms)
@endsection

@section("page-body")

<div>
    <h3>User Audit</h3>
</div>

@include('incs.profile.basic')

@include('incs.bank.details')

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

{{-- Fund Transfer is currently unavailable --}}
{{-- <div class="row mb-5">
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
</div> --}}

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
                        <td class="table-success">
                            &#x20A6;{{ $balance['total'] }}
                        </td>
                        <td class="table-danger">
                            &#x20A6;{{ $balance['payable'] }}
                        </td>
                        <td class="text-right">
                            &#x20A6;{{ $balance['reminant'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row mt-5">
    @if ($requested)
    <div class="col-12 p-3 text-center">
        <a class="btn btn-success btn-lg btn-icon-split m-auto" role="button">
            <span class="text-white-50 icon">
                <i class="fas fa-dollar-sign"></i>
            </span>
            <span class="text-white text">
                Pay User &#x20A6;{{ $balance['payable'] }}
            </span>
        </a>

        <a class="btn btn-danger btn-lg btn-icon-split m-auto" href="{{ route('admin.payouts.cancel', [
            'user_id' => $user->id
        ]) }}" role="button">
            <span class="text-white-50 icon">
                <i class="fas fa-trash"></i>
            </span>
            <span class="text-white text">
                Cancel Request
            </span>
        </a>
    </div>
    @endif

    <div class="col-12 p-3 bg-dark text-white rounded shadow-lg">
        <form class="full_ajform" action="{{ route('admin.audit.message.user') }}" method="POST">
            <h5>Send user a message</h5>
            
            <input type="hidden" name="recipent" value="{{ $user->id }}"/>

            <div class="form-group">
                <textarea class="border-info form-control" placeholder="Message for user..." name="message" rows="4" required="" spellcheck="true"></textarea>
            </div>

            <div class="form-group">
                <label class="d-block">
                    Message Type:
                </label>
                <div class="custom-control custom-control-inline text-success custom-radio">
                    <input class="custom-control-input" type="radio" id="message_type_positive" name="type" value="p" required="" checked="">
                    <label class="custom-control-label btn btn-sm btn-outline-success" for="message_type_positive">
                        Positive
                    </label>
                </div>

                <div class="custom-control custom-control-inline text-danger custom-radio">
                    <input class="custom-control-input" type="radio" id="message_type_negative" name="type" value="n" required="">
                    <label class="custom-control-label btn btn-sm btn-outline-danger" for="message_type_negative">
                        Negative
                    </label>
                </div>
            </div>
            
            {{-- <div class="form-group text-right">
                <a class="btn btn-success btn-icon-split" role="button">
                    <span class="text-white-50 icon">
                        <i class="far fa-envelope"></i>
                    </span>
                    <span class="text-white text">
                        Send Mesage
                    </span>
                </a>
            </div> --}}
            @aj_response

            @aj_submit(Send Message)
        </form>
</div>

@endsection
