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

<div class="d-sm-flex justify-content-between align-items-center mb-4">
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


<form id="payouts_form" action="{{ route('admin.mass.payouts.process') }}" class="" method="POST" v-on:submit.prevent="submitForm">
    
    <div id="payout_requests">

        <div class="row align-items-center border-bottom payout_request_row pb-2 pt-2" v-for="request in requests" v-bind:class="{ 'text-danger': request.pay_err}">
            <div class="col" 
                v-bind:class="{ pay_error: request.pay_err }">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input mass_payout" type="checkbox" v-bind:id="'request-'+request.rid" v-bind:value="request.rid" v-bind:data-amt="request.csh_rw" v-bind:disabled="request.pay_err" v-on:change="attachEvent" name="mass_payout[]" />
                        
                    <label class="custom-control-label mass_payout_label" v-bind:for="'request-' + request.rid">
                        <span class="user_key">@{{ request.key }}</span>
                        <strong class="user_name">@{{ request.nme }}</strong>
                    </label>
                </div>
            </div>

            <div class="col-auto">
                &#x20A6;<span class="amount">@{{ request.csh_fm }}</span>
            </div>

            <div class="col-auto">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-info btn-sm mr-2 audit_link" role="button" target="_blank" v-bind:href="request.aud">
                        Audit
                    </a>

                    <button class="btn btn-sm btn-icon-split pay_user" type="button" role="button" v-bind:data-reqid="request.rid" v-bind:class="{ 'btn-danger' : request.pay_err, 'btn-success' : !request.pay_err }" v-bind:disabled="request.pay_err">
                        <span class="text-white-50 icon">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <span class="text-white text">
                            @{{ request.pay_err ? 'Bank Error' : 'Pay' }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="border rounded shadow-lg" id="pay_selected_users_block" v-bind:class="showSubmitContainer">
        <button class="btn btn-success btn-icon-split" type="submit" id="pay_selected_users" v-bind:disabled="selectedUsersCount == 'None' || submitBTNDisabled">
            <span class="text-white-50 icon loading-icon">
                <i v-bind:class="loadingBTNIcon"></i>
            </span>
            <span class="text-white text">
                Pay Selected Users
            </span>
        </button>

        <div>
            <span class="font-weight-bold">
                Total Selected: @{{ selectedUsersCount }}
            </span>
        </div>

        <div>
            <span class="font-weight-bold">
                Grand Cost:
            </span>
            &#x20A6;@{{ grandCost }}
        </div>
    </div>
    
    <button id="load-requests" class="btn btn-light btn-icon-split mt-4 ml-auto mr-auto d-block auto-load" type="button" data-url="{{ route('admin.payouts.process') }}" data-page="0">
        <span class="text-black-50 icon">
            <i class="fas fa-clipboard-list"></i>
        </span>
        <span class="text-dark text">
            Load more
        </span>
</form>    

</button>
@endsection
