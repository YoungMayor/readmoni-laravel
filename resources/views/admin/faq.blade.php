@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")

@endsection

@section("page-body")

<h2 class="text-center">Frequently Asked Questions</h2>
<p>Questions. Click to expand</p>
<div class="mb-5">
    <!-- Start: Collapsible Card -->
    <div class="shadow card"><a class="btn btn-link text-left card-header font-weight-bold" data-toggle="collapse"
            aria-expanded="false" aria-controls="faq-1" href="#faq-1" role="button">Collapsible Card Example</a>
        <div class="collapse" id="faq-1">
            <div class="card-body">
                <p class="m-0">This is a collapsable card example using Bootstrap's built in collapse
                    functionality.&nbsp;<strong>Click on the card header</strong>&nbsp;to see the card body collapse and
                    expand!</p>
            </div>
            <div class="text-center text-white bg-dark p-2"><span class="small">Question asked by: <strong>Meyoron
                        Aghogho</strong>&nbsp;<a
                        href="mail:youngmar08@gmail.com"><em>youngmayor08@gmail.com</em></a></span></div>
            <div class="text-center p-2">
                <div class="btn-group" role="group"><button class="btn btn-outline-info" type="button"><i
                            class="far fa-edit"></i><span class="pl-2">Edit FAQ</span></button><button
                        class="btn btn-danger" type="button"><span class="pr-2">Delete FAQ</span><i
                            class="far fa-trash-alt"></i></button></div>
            </div>
        </div>
    </div>
    <!-- End: Collapsible Card -->
    <!-- Start: Collapsible Card -->
    <div class="shadow card"><a class="btn btn-link text-left card-header font-weight-bold" data-toggle="collapse"
            aria-expanded="false" aria-controls="faq-2" href="#faq-2" role="button">Collapsible Card Example</a>
        <div class="collapse" id="faq-2">
            <div class="card-body">
                <p class="m-0">This is a collapsable card example using Bootstrap's built in collapse
                    functionality.&nbsp;<strong>Click on the card header</strong>&nbsp;to see the card body collapse and
                    expand!</p>
            </div>
            <div class="text-center text-white bg-dark p-2"><span class="small">Question asked by: <strong>Meyoron
                        Aghogho</strong>&nbsp;<a
                        href="mail:youngmar08@gmail.com"><em>youngmayor08@gmail.com</em></a></span></div>
            <div class="text-center p-2">
                <div class="btn-group" role="group"><button class="btn btn-outline-info" type="button"><i
                            class="far fa-edit"></i><span class="pl-2">Edit FAQ</span></button><button
                        class="btn btn-danger" type="button"><span class="pr-2">Delete FAQ</span><i
                            class="far fa-trash-alt"></i></button></div>
            </div>
        </div>
    </div>
    <!-- End: Collapsible Card -->
    <!-- Start: Collapsible Card -->
    <div class="shadow card"><a class="btn btn-link text-left card-header font-weight-bold" data-toggle="collapse"
            aria-expanded="false" aria-controls="faq-3" href="#faq-3" role="button">Collapsible Card Example</a>
        <div class="collapse" id="faq-3">
            <div class="card-body">
                <p class="m-0">This is a collapsable card example using Bootstrap's built in collapse
                    functionality.&nbsp;<strong>Click on the card header</strong>&nbsp;to see the card body collapse and
                    expand!</p>
            </div>
            <div class="text-center text-white bg-dark p-2"><span class="small">Question asked by: <strong>Meyoron
                        Aghogho</strong>&nbsp;<a
                        href="mail:youngmar08@gmail.com"><em>youngmayor08@gmail.com</em></a></span></div>
            <div class="text-center p-2">
                <div class="btn-group" role="group"><button class="btn btn-outline-info" type="button"><i
                            class="far fa-edit"></i><span class="pl-2">Edit FAQ</span></button><button
                        class="btn btn-danger" type="button"><span class="pr-2">Delete FAQ</span><i
                            class="far fa-trash-alt"></i></button></div>
            </div>
        </div>
    </div>
    <!-- End: Collapsible Card -->
</div>
<!-- Start: Split Button Success --><button class="btn btn-primary btn-lg btn-icon-split d-block m-auto"><span
        class="text-white-50 icon"><i class="fas fa-plus"></i></span><span class="text-white text">Add
        Question</span></button>
<!-- End: Split Button Success -->
<form class="mt-5" action="add_question" method="post">
    <h6 class="text-center text-black-50">FAQ's are publicly displayed. Verify before saving</h6>
    <div class="form-group"><textarea class="form-control" name="question" placeholder="Question here" rows="5"
            required=""></textarea><small class="form-text text-center text-muted">* Keep the question as short and
            descriptive as possible</small></div>
    <div class="form-group"><textarea class="form-control" name="answer" placeholder="Answer to the above question"
            rows="5" required=""></textarea><small class="form-text text-center text-muted">* A well presented and
            accurate answer</small></div>

    @endsection