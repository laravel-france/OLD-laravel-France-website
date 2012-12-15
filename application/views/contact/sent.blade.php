@layout('main')

@section('title')
    Message envoyé - Laravel France
@endsection

@section('content')
    
    <article>
        
        <header>
            <h1>Contact</h1>
        </header>

        <section>
            <p>Votre message a bien été envoyé. Merci, nous vous adresserons une réponse dès que possible.</p>

            <a href="{{ URL::home() }}" class="btn btn-primary">Retour à la page d'accueil</a>
        </section>
@endsection