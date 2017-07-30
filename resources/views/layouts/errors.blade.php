@if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
                <strong>Oh snap!</strong> <span>{{$error}}</span>
            </div>
        @endforeach
    </ul>
@endif
