@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")
@css(profile, 1)
@endsection

@section("page-js")
@js(imgPreviewer)
@js(edit-profile)
@js(ajax-forms)
@endsection

@section("page-body")
<div class="row mb-5">
    <div class="col-10 m-auto m-320">
        <div class="border rounded-circle d-flex" id="avatar-preview" style="">
            <style>
                #avatar-preview{
                    background-image: url('{{ RM::avatar() }}');
                }
            </style>
            <label class="shadow-lg place-center btn btn-outline-success" for="avatar">
                Select Avatar
                <button class="btn btn-outline-danger ml-2" id="reset_avatar" type="button">
                    <i class="fa fa-refresh"></i>
                </button>
            </label>
        </div>
    </div>
    <div class="w-100"></div>
    <div class="col-12 text-right">
        <form class="" action="{{ route('user.profile.edit.avatar') }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="file" id="avatar" class="d-none show_imgpreview" name="avatar" accept="image/*" data-previewbox="#avatar-preview" required="">

            @error('avatar')
                <div class="text-right text-danger">
                    <small>{{ $message }}</small>
                </div>
            @enderror

            @if(session('avatar_succes'))
                <div class="text-right text-success">
                    <small>{{ session('avatar_succes') }}</small>
                </div>
            @endif

            @aj_submit(Update Avatar)
        </form>
    </div>
</div>

<h1>Basic Profile Edit</h1>
<div class="row">
    <div class="col">
        <form class="full_ajform" action="{{ route('user.profile.edit.nick') }}" method="post">
            <div class="form-group">
                <label>Edit Nick:</label>
                <input class="form-control" type="text" id="nickname" name="nickname" placeholder="Unique Nickname" required="" value="{{ $user->chat_name }}">
                
                @aj_response
                @aj_submit(Update Nickname)
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <form class="full_ajform" action="{{ route('user.profile.edit.name') }}" method="post">
            <div class="form-group">
                <label>Edit Name:</label>
                <input class="form-control" type="text" name="name" placeholder="Your full name" value="{{ $user->full_name }}">
                
                @aj_response
                @aj_submit(Update Nickname)
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col">
        <form class="full_ajform" action="{{ route('user.profile.edit.phone') }}" method="post">
            <div class="form-group">
                <label>Edit Phone Number:</label>
                <input class="form-control" type="tel" id="phone" name="phone" placeholder="Phone Number" required="" value="{{ $user->telephone }}">
                
                @aj_response
                @aj_submit(Update Phone)
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col">
        <form class="full_ajform" action="{{ route('user.profile.edit.dob') }}" method="post">
            <div class="form-group">
                <label>Edit Date of Birth:</label>
                <div class="form-row">
                    <div class="col">
                        <input class="form-control d-inline-block" type="date" id="dob" name="dob" required="" value="{{ $user->dob }}">
                    </div>
                    <div class="col">
                        @aj_response
                        @aj_submit(Update)
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col">
        <form class="full_ajform" action="{{ route('user.profile.edit.sex') }}" method="post">
            <div class="form-group">
                <label>Edit Gender:</label>
                <div class="form-row">
                    <div class="col">
                        {!! RM::genderSelect($user->sex) !!}
                    </div>
                    <div class="col align-self-center">
                        @aj_response
                        @aj_submit(Update Gender)
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col">
        <form class="full_ajform" action="{{ route('user.profile.edit.address') }}" method="post">
            <div class="form-group">
                <label>Edit Home Address:</label>
                <textarea class="form-control" name="address" id="address" placeholder="Your home address" rows="4" required="">{{ $user->address }}</textarea>

                @aj_response
                @aj_submit(Update Address)
            </div>
        </form>
    </div>
</div>

<h1>Bank Details Edit</h1>
<div class="row">
    <div class="col">
        <form class="full_ajform" action="{{ route('user.bank.edit') }}" method="post">
            <div class="form-group">
                <label>
                    Select Bank:
                </label>
                
                <select class="custom-select" name="bank" required="">
                    {{ RM::bankSelectOptions() }}
                </select>
            </div>

            <div class="form-group">
                <label>Account Name:</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Your account name" required="" value="{{ $bank->account_name }}">
            </div>
            <div class="form-group">
                <label>Account Number:</label>
                <input class="form-control" type="text" name="number" id="number" placeholder="Your account number" required="" value="{{ $bank->account_number }}">
            </div>

            @aj_response
            @aj_submit(Save Bank Info)
        </form>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12 p-3">
        <a class="btn btn-warning btn-block" role="button" href="edit-password.html">Change Password</a>
    </div>
</div>
@endsection
