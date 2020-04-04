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
        <div class="border rounded-circle" id="avatar-preview" style="background-image: url(&quot;assets/img/readmoni_icon.png?h=388ced5e854f6959f88fd6932e46fa94&quot;);"></div>
    </div>
    <div class="w-100"></div>
</div>
<div class="row mb-5">
    <div class="col">
        <h5>Basic Profile</h5>
        <div>
            <h2 class="text-uppercase text-center">MEYORON AGHOGHO</h2>
            <span class="text-uppercase text-center d-block">(AB-1234C)</span>
        </div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="far fa-envelope fa-2x"></i>
    </div>
    <div class="col-8 text-break align-self-center">
        <span>youngmayor08@gmail.com</span>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="fa fa-phone fa-2x"></i>
    </div>
    <div class="col-8 text-break align-self-center">
        <span>08075178485</span>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="far fa-comments fa-2x"></i>
    </div>
    <div class="col-8 text-break align-self-center">
        <span>young.mayor.32</span>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="fas fa-home fa-2x"></i>
    </div>
    <div class="col-8 text-break align-self-center">
        <span>Somewhere in planet earth</span>
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="col text-center d-flex justify-content-center align-items-center">
        <i class="fas fa-calendar-alt fa-2x text-success p-1"></i>
        <span>May 10th, 2020</span>
    </div>
    <div class="col text-center d-flex justify-content-center align-items-center">
        <i class="fas fa-user-alt fa-2x text-success p-1"></i>
        <span>Male</span>
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
        <small class="text-danger">Please ensure that the informations given above are correct. Payments would be made to the above stated account details.</small>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12 p-3">
        <a class="btn btn-success btn-block" role="button" href="edit-profile.html">Edit Profile</a>
    </div>
    <div class="col-12 p-3">
        <a class="btn btn-warning btn-block" role="button" href="edit-password.html">Change Password</a>
    </div>
</div>

@endsection
