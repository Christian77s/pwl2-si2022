@if($massage = Session::get('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Yahoo!</strong> {{$massage}}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
@endif