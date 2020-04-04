@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<h2 class="text-center">Frequently Asked Questions</h2>
<p>Here are some frequently asked questions by other users</p>
<!-- Start: Collapsible Card -->
<div class="shadow card">
    <a class="btn btn-link text-left card-header font-weight-bold" data-toggle="collapse" aria-expanded="false" aria-controls="faq-1" href="#faq-1" role="button">Collapsible Card Example</a>
    <div class="collapse" id="faq-1">
        <div class="card-body">
            <p class="m-0">
                This is a collapsable card example using Bootstrap's built in collapse functionality.&nbsp;<strong>Click on the card header</strong>
                &nbsp;to see the card body collapse and expand!
            </p>
        </div>
    </div>
</div>
<!-- End: Collapsible Card -->
<!-- Start: Collapsible Card -->
<div class="shadow card">
    <a class="btn btn-link text-left card-header font-weight-bold" data-toggle="collapse" aria-expanded="false" aria-controls="faq-2" href="#faq-2" role="button">Collapsible Card Example</a>
    <div class="collapse" id="faq-2">
        <div class="card-body">
            <p class="m-0">
                This is a collapsable card example using Bootstrap's built in collapse functionality.&nbsp;<strong>Click on the card header</strong>
                &nbsp;to see the card body collapse and expand!
            </p>
        </div>
    </div>
</div>
<!-- End: Collapsible Card -->
<!-- Start: Collapsible Card -->
<div class="shadow card">
    <a class="btn btn-link text-left card-header font-weight-bold" data-toggle="collapse" aria-expanded="false" aria-controls="faq-3" href="#faq-3" role="button">Collapsible Card Example</a>
    <div class="collapse" id="faq-3">
        <div class="card-body">
            <p class="m-0">
                This is a collapsable card example using Bootstrap's built in collapse functionality.&nbsp;<strong>Click on the card header</strong>
                &nbsp;to see the card body collapse and expand!
            </p>
        </div>
    </div>
</div>
<!-- End: Collapsible Card -->
<form class="mt-5" action="ask_question" method="post">
    <h6 class="text-center text-black-50">Didn't find answer to the question in your mind? Then ask us here. We're waiting to hear from you.</h6>
    <div class="form-row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="Your name" required="">
                <small class="form-text text-center text-muted">* Needed to help our administrative team identify you.</small>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Your email address" required="">
                <small class="form-text text-center text-muted">* Response to your question would be sent here</small>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <textarea class="form-control" name="question" placeholder="Your question..." rows="5" required=""></textarea>
                <small class="form-text text-center text-muted">* Keep your question as short and descriptive as possible</small>
            </div>
        </div>
    </div>
    <div class="form-group text-right">
        <!-- Start: Split Button Success -->
        <button class="btn btn-success btn-icon-split" type="submit">
            <span class="text-white-50 icon">
                <i class="fas fa-check"></i>
            </span>
            <span class="text-white text">Send Question</span>
        </button>
        <!-- End: Split Button Success -->
    </div>
</form>
@endsection
