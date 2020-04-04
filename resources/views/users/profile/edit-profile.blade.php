@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")
@js(imgPreview)
@js(edit-profile)
@endsection

@section("page-body")
<div class="row mb-5">
    <div class="col-10 m-auto m-320">
        <div class="border rounded-circle d-flex" id="avatar-preview" style="background-image: url(&quot;assets/img/readmoni_icon.png?h=388ced5e854f6959f88fd6932e46fa94&quot;);">
            <label class="shadow-lg place-center btn btn-outline-success" for="change_avatar">
                Select Avatar
                <button class="btn btn-outline-danger ml-2" id="reset_avatar" type="button">
                    <i class="fa fa-refresh"></i>
                </button>
            </label>
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col-12 text-right">
        <form action="update-avatar" method="post" enctype="multipart/form-data">
            <input type="file" id="change_avatar" class="d-none show_imgpreview" name="change_avatar" accept="image/*" data-previewbox="#avatar-preview" required="">
            <!-- Start: Split Button Success -->
            <button class="btn btn-success btn-icon-split" type="submit">
                <span class="text-white-50 icon">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text-white text">Update Avatar</span>
            </button>
            <!-- End: Split Button Success -->
        </form>
    </div>
</div>
<h1>Basic Profile Edit</h1>
<div class="row">
    <div class="col">
        <form action="edit_nick" method="post">
            <div class="form-group">
                <label>Edit Nick:</label>
                <input class="form-control" type="text" name="edit_nick" placeholder="Unique Nickname" required="">
                <div class="text-right text-danger">
                    <small>Any error text would be placed here</small>
                </div>
                <!-- Start: Split Button Success -->
                <button class="btn btn-success btn-icon-split d-block ml-auto" type="submit">
                    <span class="text-white-50 icon">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text-white text">Update Nickname</span>
                </button>
                <!-- End: Split Button Success -->
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <form action="edit_name" method="post">
            <div class="form-group">
                <label>Edit Name:</label>
                <input class="form-control" type="text" name="edit_name" placeholder="Your full name">
                <div class="text-right text-danger">
                    <small>Any error text would be placed here</small>
                </div>
                <!-- Start: Split Button Success -->
                <button class="btn btn-success btn-icon-split d-block ml-auto" type="submit">
                    <span class="text-white-50 icon">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text-white text">Update Name</span>
                </button>
                <!-- End: Split Button Success -->
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <form action="edit_phone" method="post">
            <div class="form-group">
                <label>Edit Phone Number:</label>
                <input class="form-control" type="text" name="edit_phone" placeholder="Phone Number" required="">
                <div class="text-right text-danger">
                    <small>Any error text would be placed here</small>
                </div>
                <!-- Start: Split Button Success -->
                <button class="btn btn-success btn-icon-split d-block ml-auto" type="submit">
                    <span class="text-white-50 icon">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text-white text">Update Phone</span>
                </button>
                <!-- End: Split Button Success -->
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <form action="edit_dob" method="post">
            <div class="form-group">
                <label>Edit Date of Birth:</label>
                <div class="form-row">
                    <div class="col">
                        <input class="form-control d-inline-block" type="date" name="edit_dob" required="">
                    </div>
                    <div class="col">
                        <!-- Start: Split Button Success -->
                        <button class="btn btn-success btn-icon-split d-block ml-auto" type="submit">
                            <span class="text-white-50 icon">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text-white text">Update Birthday</span>
                        </button>
                        <!-- End: Split Button Success -->
                    </div>
                    <div class="col-12 text-right text-danger">
                        <small>Any error text would be placed here</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <form action="edit_gender" method="post">
            <div class="form-group">
                <label>Edit Gender:</label>
                <div class="form-row">
                    <div class="col">
                        <div class="custom-control custom-control-inline custom-radio">
                            <input class="custom-control-input" type="radio" id="gender_male" name="gender" value="m" required="">
                            <label class="custom-control-label" for="gender_male">Male</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio">
                            <input class="custom-control-input" type="radio" id="gender_female" name="gender" value="f" required="">
                            <label class="custom-control-label" for="gender_female">Female</label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio">
                            <input class="custom-control-input" type="radio" id="gender_undefined" name="gender" value="u" checked="" required="">
                            <label class="custom-control-label" for="gender_undefined">Rather not say</label>
                        </div>
                    </div>
                    <div class="col align-self-center">
                        <!-- Start: Split Button Success -->
                        <button class="btn btn-success btn-icon-split d-block ml-auto" type="submit">
                            <span class="text-white-50 icon">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text-white text">Update Gender</span>
                        </button>
                        <!-- End: Split Button Success -->
                    </div>
                    <div class="col-12 text-right text-danger">
                        <small>Any error text would be placed here</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <form action="edit_address" method="post">
            <div class="form-group">
                <label>Edit Home Address:</label>
                <textarea class="form-control" name="edit_address" placeholder="Your home address" rows="4" required=""></textarea>
                <div class="text-right text-danger">
                    <small>Any error text would be placed here</small>
                </div>
                <!-- Start: Split Button Success -->
                <button class="btn btn-success btn-icon-split d-block ml-auto" type="submit">
                    <span class="text-white-50 icon">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text-white text">Update Address</span>
                </button>
                <!-- End: Split Button Success -->
            </div>
        </form>
    </div>
</div>
<h1>Bank Details Edit</h1>
<div class="row">
    <div class="col">
        <form action="edit_bankcred" method="post">
            <div class="form-group">
                <label>Bank Name:</label>
                <input class="form-control" type="text" name="edit_bank_name" placeholder="Name of Bank in Nigeria" required="">
            </div>
            <div class="form-group">
                <label>Account Name:</label>
                <input class="form-control" type="text" name="edit_account_name" placeholder="Your account name" required="">
            </div>
            <div class="form-group">
                <label>Account Number:</label>
                <input class="form-control" type="text" name="edit_account_number" placeholder="Your account number" required="">
            </div>
            <div class="form-group">
                <div class="text-right text-danger">
                    <small>Any error text would be placed here</small>
                </div>
                <!-- Start: Split Button Success -->
                <button class="btn btn-success btn-icon-split d-block ml-auto" type="submit">
                    <span class="text-white-50 icon">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text-white text">Update Nickname</span>
                </button>
                <!-- End: Split Button Success -->
            </div>
        </form>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12 p-3">
        <a class="btn btn-warning btn-block" role="button" href="edit-password.html">Change Password</a>
    </div>
</div>
@endsection
