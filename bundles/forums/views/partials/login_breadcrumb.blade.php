@if(Auth::guest())
    <li class="pull-right" style="margin-top: -3px;">
        <a class="btn btn-small btn-github @if(isset($have_github))
        disabled
        @endif" href="{{ URL::to('oneauth/session/github') }}">
            <i class="icon-github"></i> Connexion via Github
        </a>

        <a class="btn btn-small btn-twitter @if(isset($have_twitter))
        disabled
        @endif" href="{{ URL::to('oneauth/session/twitter') }}">
            <i class="icon-twitter"></i> Connexion via Twitter
        </a>

        <a class="btn btn-small btn-google @if(isset($have_google))
        disabled
        @endif" href="{{ URL::to('oneauth/session/google') }}">
            <i class="icon-google-plus-sign"></i> Connexion via Google
        </a>
    </li>
@endif
