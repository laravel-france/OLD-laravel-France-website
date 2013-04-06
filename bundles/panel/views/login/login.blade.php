@layout('main')

@section('content')
    <div class="row">
        <div class="offset4 span4">
            <h2>Login</h2>

            <p>
                <a class="btn btn-github" href="{{ URL::to('oneauth/session/github') }}">
                    <i class="icon-github"></i> Se connecter avec Github
                </a>
            </p>

            <p>
                <a class="btn btn-twitter" href="{{ URL::to('oneauth/session/twitter') }}">
                    <i class="icon-twitter"></i> Se connecter avec Twitter
                </a>
            </p>

            <p>
                <a class="btn btn-google" href="{{ URL::to('oneauth/session/google') }}">
                    <i class="icon-google-plus-sign"></i> Se connecter avec Google
                </a>
            </p>

        </div>
    </div>
@endsection