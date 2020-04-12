@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")

<h2 class="text-black-50 font-weight-bold">Notifications</h2>

<div id="notifications-container">
    
</div>

<button id="load-notifications" class="btn btn-light btn-icon-split mt-4 ml-auto mr-auto d-block" type="button" data-store="#notifications-container" data-url="{{ route('user.notifications.process') }}" data-page="0">
    <span class="text-black-50 icon">
        <i class="fas fa-clipboard-list"></i>
    </span>
    <span class="text-dark text">Load more</span></button>
@endsection
