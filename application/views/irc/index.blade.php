@layout('main')

@section('title')
    IRC - Laravel France
@endsection

@section('content')
    
    <ul class="breadcrumb">
        <li><a title="Retour à la page d'accueil" href="{{ URL::home() }}"><i class="icon-home"></i></a> <span class="divider">/</a></li>
        <li>IRC</li>
    </ul>

    <article>
        
        <header>
            <h1>#laravel.fr IRC</h1>
        </header>

        <section>
            <p>
                Vous pouvez nous rejoindre sur le channel IRC #laravel.fr du serveur irc.freenode.net. Si vous n'avez pas de client IRC, 
                vous pouvez chatter avec nous directement depuis votre navigateur :
            </p>

            <iframe src="http://webchat.freenode.net?randomnick=1&amp;channels=laravel,laravel.fr&amp;prompt=1" width="100%" height="400"></iframe>

        </section>
@endsection