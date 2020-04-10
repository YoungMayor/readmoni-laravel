@if ($errors->any())
@foreach ($errors->all() as $error)
<small class="d-block"><i class="fa fa-warning"></i>{{ $error }}</small>
@endforeach
@endif

