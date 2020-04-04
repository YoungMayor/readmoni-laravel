@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")
@css(team-boxed)
@endsection

@section("page-js")

@endsection

@section("page-body")

<h2 class="text-center">User's Testimonies</h2>
<p>
    Not sure if to believe? <br>Here are some Reviews and Testimonies from other users
</p>
<div class="team-boxed">
    <!-- Start: People -->
    <div class="row people p-0">
        <div class="col-md-6 col-lg-4 item">
            <div class="box">
                <img class="rounded-circle img-fluid" src="assets/img/1.jpg?h=96f91f3af160be29067586ba1ec647ae">
                <h3 class="name">Young Mayor</h3>
                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 item">
            <div class="box">
                <img class="rounded-circle" src="assets/img/2.jpg?h=beb634b26fa60631119d61e53fbc88a6">
                <h3 class="name">Anthonia Smart</h3>
                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 item">
            <div class="box">
                <img class="rounded-circle" src="assets/img/3.jpg?h=5de8ab3c0edbaa4585c17739933ea1e8">
                <h3 class="name">Charlie White</h3>
                <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
            </div>
        </div>
    </div>
    <!-- End: People -->
</div>
<form class="mt-5" action="drop_testimony" method="post">
    <h6 class="text-center text-black-50">Want to spread the world. Fill the form to drop your testimony below</h6>
    <div class="form-group">
        <textarea class="form-control" name="testimony" placeholder="Your testimony/review" rows="6" required=""></textarea>
    </div>
    <div class="form-group text-right">
        <!-- Start: Split Button Success -->
        <button class="btn btn-success btn-icon-split" type="submit">
            <span class="text-white-50 icon">
                <i class="fas fa-check"></i>
            </span>
            <span class="text-white text">Send</span>
        </button>
        <!-- End: Split Button Success -->
    </div>
</form>

@endsection
