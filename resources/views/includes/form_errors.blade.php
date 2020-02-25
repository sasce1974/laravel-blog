@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        @foreach($errors->all() as $error)
            <i class="fa fa-exclamation-circle mx-2"></i><strong>ERROR!</strong> {{$error}} <br>
        @endforeach
    </div>
@endif