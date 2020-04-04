@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")
@css(news-list)
@endsection

@section("page-js")

@endsection

@section('page-body-class', "pl-0 pr-0")

@section("page-body")
<div class="bg-white shadow d-flex h-list" id="news-category-ctrl">
    <button class="btn btn-outline-secondary btn-sm m-2" type="button">Health</button>
    <button class="btn btn-outline-secondary btn-sm m-2" type="button">Science</button>
    <button class="btn btn-outline-secondary btn-sm m-2" type="button">Business</button>
    <button class="btn btn-outline-secondary btn-sm m-2" type="button">Sports</button>
    <button class="btn btn-outline-secondary btn-sm m-2" type="button">World at Large</button>
    <button class="btn btn-outline-secondary btn-sm m-2" type="button">Science</button>
    <button class="btn btn-outline-secondary btn-sm m-2" type="button">Business</button>
    <button class="btn btn-outline-secondary btn-sm m-2" type="button">Sports</button>
</div>
<div id="news-list" class="p-3">
    <!-- Start: Blog Post Card -->
    <div class="row blog-card mb-3 p-2 shadow-sm rounded">
        <div class="col blog-card-details p-0">
            <a class="text-left btn p-0" href="blog-post.html">
                <h4 class="text-dark blog-post-title">The Full Title of the News</h4>
                <p>
                    <em>The short extract from the news would be shown here as a preview...</em>
                </p>
            </a>
        </div>
        <div class="col-4 news-card-image" style="background-image: url(&quot;assets/img/background.jpg?h=d75895f87214c01baf417f87ab6a932e&quot;);">
            <img class="d-none">
        </div>
    </div>
    <!-- End: Blog Post Card -->
    <!-- Start: Blog Post Card -->
    <div class="row blog-card mb-3 p-2 shadow-sm rounded">
        <div class="col blog-card-details p-0">
            <a class="text-left btn p-0" href="blog-post.html">
                <h4 class="text-dark blog-post-title">The Full Title of the News</h4>
                <p>
                    <em>The short extract from the news would be shown here as a preview...</em>
                </p>
            </a>
        </div>
        <div class="col-4 news-card-image" style="background-image: url(&quot;assets/img/background.jpg?h=d75895f87214c01baf417f87ab6a932e&quot;);">
            <img class="d-none">
        </div>
    </div>
    <!-- End: Blog Post Card -->
    <!-- Start: Blog Post Card -->
    <div class="row blog-card mb-3 p-2 shadow-sm rounded">
        <div class="col blog-card-details p-0">
            <a class="text-left btn p-0" href="blog-post.html">
                <h4 class="text-dark blog-post-title">The Full Title of the News</h4>
                <p>
                    <em>The short extract from the news would be shown here as a preview...</em>
                </p>
            </a>
        </div>
        <div class="col-4 news-card-image" style="background-image: url(&quot;assets/img/background.jpg?h=d75895f87214c01baf417f87ab6a932e&quot;);">
            <img class="d-none">
        </div>
    </div>
    <!-- End: Blog Post Card -->
    <!-- Start: Blog Post Card -->
    <div class="row blog-card mb-3 p-2 shadow-sm rounded">
        <div class="col blog-card-details p-0">
            <a class="text-left btn p-0" href="blog-post.html">
                <h4 class="text-dark blog-post-title">The Full Title of the News</h4>
                <p>
                    <em>The short extract from the news would be shown here as a preview...</em>
                </p>
            </a>
        </div>
        <div class="col-4 news-card-image" style="background-image: url(&quot;assets/img/background.jpg?h=d75895f87214c01baf417f87ab6a932e&quot;);">
            <img class="d-none">
        </div>
    </div>
    <!-- End: Blog Post Card -->
</div>

@endsection
