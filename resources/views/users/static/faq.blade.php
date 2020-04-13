@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")
@js(faq)
@js(ajax-forms)
@endsection

@section("page-body")
<h2 class="text-center">
    Frequently Asked Questions
</h2>

<p id="faq-head" data-url="{{ route('user.faq.process') }}">
    Here are some frequently asked questions by other users
</p>

@forelse ($questions as $question)
<div class="shadow card faq-card" data-id="{{ $question->id }}">
    <a class="btn btn-link text-left card-header font-weight-bold faq-question" data-toggle="collapse" aria-expanded="false" aria-controls="faq-{{ $question->id }}" href="#faq-{{ $question->id }}" role="button">
        {{ $question->question }}
    </a>
    <div class="collapse" id="faq-{{ $question->id }}">
        <div class="card-body">
            <p class="m-0 faq-answer">
                
            </p>
        </div>
    </div>
</div>
@empty
    
@endforelse

<form class="mt-5 full_ajform" action="{{ route('user.faq.ask') }}" method="post">
    <h6 class="text-center text-black-50">
        Didn't find answer to the question in your mind? Then ask us here. We're waiting to hear from you.
    </h6>

    <div class="form-row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input class="form-control" type="text" name="name" placeholder="Your name" required="">

                <small class="form-text text-center text-muted">
                    * Needed to help our administrative team identify you.
                </small>
            </div>

            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Your email address" required="">

                <small class="form-text text-center text-muted">
                    * Response to your question would be sent here
                </small>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <textarea class="form-control" name="question" placeholder="Your question..." rows="5" required=""></textarea>
                
                <small class="form-text text-center text-muted">
                    * Keep your question as short and descriptive as possible
                </small>
            </div>
        </div>
    </div>
    <div class="form-group text-right">
        @aj_response
        @aj_submit(Send Question)
    </div>
</form>
@endsection
