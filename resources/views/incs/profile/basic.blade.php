<div class="row mb-5">
    <div class="col">
        <h5>Basic Profile</h5>
        <div>
            <h2 class="text-uppercase text-center">
                {{ $user->full_name }}
            </h2>
            <span class="text-uppercase text-center d-block">
                ({{ $user->user_key }})
            </span>
        </div>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="far fa-envelope fa-2x"></i>
    </div>

    <div class="col-8 text-break align-self-center">
        <span>
            {{ $user->email }}
        </span>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="fa fa-phone fa-2x"></i>
    </div>

    <div class="col-8 text-break align-self-center">
        <span>
            {{ $user->telephone }}
        </span>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="far fa-comments fa-2x"></i>
    </div>

    <div class="col-8 text-break align-self-center">
        <span>
            {{ $user->chat_name }}
        </span>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col-2 text-center text-success align-self-center p-1">
        <i class="fas fa-home fa-2x"></i>
    </div>

    <div class="col-8 text-break align-self-center">
        <span>
            {{ $user->address }}
        </span>
    </div>

    <div class="col-12">
        <hr>
    </div>

    <div class="col text-center d-flex justify-content-center align-items-center">
        <i class="fas fa-calendar-alt fa-2x text-success p-1"></i>
        <span>
            {{ RM::beautyDate($user->dob) }}
        </span>
    </div>

    <div class="col text-center d-flex justify-content-center align-items-center">
        <i class="fas fa-user-alt fa-2x text-success p-1"></i>
        <span>
            {{ RM::parseGender($user->sex) }}
        </span>
    </div>

</div>