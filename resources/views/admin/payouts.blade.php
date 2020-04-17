@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")
@css(admin/payouts)
@endsection

@section("page-js")
@js(ajax-forms)
@js(admin/payouts)
@endsection

@section("page-body")

<div class="d-sm-flex justify-content-between align-items-center mb-4" style="margin-top: 50px;">
    <h3 class="text-dark mb-0">Payout Requests</h3>
</div>

@isOwner
<div class="row">
    <div class="col">
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <td>Account Balance</td>
                        <td class="text-right">
                            &#x20A6;{{ $PS_Bal }}
                        </td>
                    </tr>
                    <tr>
                        <td>User Funds</td>
                        <td class="text-right">
                            &#x20A6;{{ $User_Fund }}
                        </td>
                    </tr>
                    <tr>
                        <td>Profit/Loss</td>
                        <td class="table-{{ $rem_class }} text-right">
                            &#x20A6;{{ $reminant }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Pending Payouts</td>
                        <td class="text-right">
                            {{ $pending }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endisOwner


<form id="multi_pay_form" action="{{ route('admin.mass.payouts.process') }}" class="full_ajform" method="POST">
    @csrf
    <div id="payout_requests">
    </div>

    <div class="border rounded shadow-lg" id="pay_selected_users_block">
        <button class="btn btn-success btn-icon-split" type="submit" id="pay_selected_users">
            <span class="text-white-50 icon">
                <i class="fas fa-dollar-sign"></i>
            </span>
            <span class="text-white text">
                Pay Selected Users
            </span>
        </button>
    </div>
</form>    


<button id="load-requests" class="btn btn-light btn-icon-split mt-4 ml-auto mr-auto d-block auto-load" type="button" data-url="{{ route('admin.payouts.process') }}" data-page="0">
    <span class="text-black-50 icon">
        <i class="fas fa-clipboard-list"></i>
    </span>
    <span class="text-dark text">
        Load more
    </span>
</button>
@endsection
