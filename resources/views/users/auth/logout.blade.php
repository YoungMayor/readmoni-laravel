@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<div class="row">
    <div class="col text-center text-warning">
        <i class="fas fa-question tada animated infinite fa-10x"></i>
        <div class="clearfix"></div><span class="bg-danger border rounded-circle border-success spinner-grow mt-2"></span><span class="shadow spinner-grow mt-2"></span><span class="bg-success border rounded-circle border-danger spinner-grow mt-2"></span>
        <h2
            class="p-2">Confirm your logout action</h2>
    </div>
</div>
<div class="row">
    <div class="col text-center">
        <form action="{{ route('user.logout.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <button class="btn btn-danger btn-lg" type="submit">
                    <span>
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    <span>Logout</span>
                </button>
            </div>

            <div class="form-group">
                <a class="btn btn-outline-primary btn-lg" role="button" href="{{ url()->previous() }}">
                    <span>
                        <i class="fas fa-times"></i>
                    </span>
                    <span>Cancel</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
