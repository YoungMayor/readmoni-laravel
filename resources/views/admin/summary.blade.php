@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
    
<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0">Site Summary</h3>
</div>

<div class="table-responsive table-bordered">
    <table class="table table-striped table-bordered">
        <tbody>
            <tr>
                <td>Paystack Balance</td>
                <td class="text-right">N179,000</td>
            </tr>
            <tr>
                <td>Total registered users</td>
                <td class="text-right">1,900,000</td>
            </tr>
            <tr>
                <td>Registration today</td>
                <td class="text-right">129</td>
            </tr>
            <tr>
                <td>Total news read</td>
                <td class="text-right">4,800,000</td>
            </tr>
            <tr>
                <td>Total reads today</td>
                <td class="text-right">1,470</td>
            </tr>
            <tr>
                <td>Available news articles</td>
                <td class="text-right">869</td>
            </tr>
            <tr>
                <td>Richest Member</td>
                <td class="text-right">AB-1234C <br><strong>Meyoron Aghogho</strong></td>
            </tr>
            <tr>
                <td>Total registered admins</td>
                <td class="text-right">4</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
