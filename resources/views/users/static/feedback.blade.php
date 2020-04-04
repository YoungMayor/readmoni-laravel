@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")
<h2 class="text-center">Send us a feedback</h2>
<form class="mt-5" action="send_feedback" method="post">
    <h6 class="text-black-50">
        We are always happy to help provide the best experience for our users.&nbsp;<br>
        Noticed any bug or have any suggestions. Write to us then, we're waiting to hear from you...<br>
    </h6>
    <div class="form-row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="Your name" required="">
                <small class="form-text text-center text-muted">* Needed to help our administrative team identify you.</small>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Your email address" required="">
                <small class="form-text text-center text-muted">* Response to your feedback would be sent here</small>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <textarea class="form-control" name="feedback" placeholder="Your feedback..." rows="5" required=""></textarea>
            </div>
            <div class="form-group text-right">
                <!-- Start: Split Button Success -->
                <button class="btn btn-success btn-icon-split" type="submit">
                    <span class="text-white-50 icon">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text-white text">Send Feedback</span>
                </button>
                <!-- End: Split Button Success -->
            </div>
        </div>
    </div>
</form>
@endsection
