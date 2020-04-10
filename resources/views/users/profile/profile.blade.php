@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")
@css(profile)
@endsection

@section("page-js")

@endsection

@section("page-body")

<div class="row">
    <div class="col-10 m-auto m-320">
        <div class="border rounded-circle" id="avatar-preview" style="background-image: url('{{ RM::avatar() }}');"></div>
    </div>
    <div class="w-100"></div>
</div>
<div class="row mb-5">
    <div class="col">
        <h5>Basic Profile</h5>
        <div>
            <h2 class="text-uppercase text-center">
                {{ $user->full_name }}
            </h2>
            <span class="text-uppercase text-center d-block">
                ({{ $user->user_key }})
            </span>
        </div>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="far fa-envelope fa-2x"></i>
    </div>

    <div class="col-8 text-break align-self-center">
        <span>
            {{ $user->email }}
        </span>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="fa fa-phone fa-2x"></i>
    </div>

    <div class="col-8 text-break align-self-center">
        <span>
            {{ $user->telephone }}
        </span>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="far fa-comments fa-2x"></i>
    </div>

    <div class="col-8 text-break align-self-center">
        <span>
            {{ $user->chat_name }}
        </span>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="fas fa-home fa-2x"></i>
    </div>

    <div class="col-8 text-break align-self-center">
        <span>
            {{ $user->address }}
        </span>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col text-center d-flex justify-content-center align-items-center">
        <i class="fas fa-calendar-alt fa-2x text-success p-1"></i>
        <span>
            {{ RM::beautyDate($user->dob) }}
        </span>
    </div>

    <div class="col text-center d-flex justify-content-center align-items-center">
        <i class="fas fa-user-alt fa-2x text-success p-1"></i>
        <span>
            {{ RM::parseGender($user->sex) }}
        </span>
    </div>

</div>

<div class="row">
    <div class="col">
        <h5>Banking Details</h5>
    </div>

    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Bank Name</td>
                        <td>{{ $bank->bank_name ?? "No Bank Set" }}</td>
                    </tr>
                    <tr>
                        <td>Account Name</td>
                        <td>{{ $bank->account_name ?? "Account Name not set" }}</td>
                    </tr>
                    <tr>
                        <td>Account No.</td>
                        <td>{{ $bank->account_number ?? "Account Number not set" }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <small class="text-danger">
            Please ensure that the informations given above are correct. Payments would be made to the above stated account details.
        </small>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12 p-3">
        <a class="btn btn-success btn-block" role="button" href="{{ route('user.profile.edit.page') }}">Edit Profile</a>
    </div>

    <div class="col-12 p-3">
        <a class="btn btn-warning btn-block" role="button" href="#">Change Password</a>
    </div>
</div>

@endsection
