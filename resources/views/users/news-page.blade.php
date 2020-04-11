@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")
@css(news-list)
@endsection

@section("page-js")
@js(news-list)
@endsection

@section('page-body-class', "pl-0 pr-0")

@section("page-body")
<div class="bg-white shadow d-flex h-list" id="news-category-ctrl" data-target="{{ route('user.news.load') }}">
    @foreach ($categories as $id => $label)
        <button class="btn btn-outline-secondary btn-sm m-2 switch_category" data-cat="{{ $id }}" data-page="0" type="button">{{ $label }}</button>    
    @endforeach
</div>
<div id="news-list" class="p-3"></div>
<button id="get_news" class="btn btn-outline-secondary btn-sm m-auto d-block" type="button">Load News</button>   

@endsection
