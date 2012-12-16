@layout('main')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/blog/css/blog.css')) }}
@endsection


@section('content')
    <div class="row">

        <div class="span3">

            @yield('over_menu')

            <nav class="well">
                <h3>Billets</h3>
                <ul>
                    <li>{{ HTML::link_to_action('blog::admin.post@new','Nouvel article') }}</li>
                    <li>{{ HTML::link_to_action('blog::admin.post@list','Gestion des articles') }}</li>
                </ul>
            </nav>
        </div>

        <div class="span9">
                <h2>Administration</h2>
                @yield('admincontent')
        </div>
    </div>
@endsection