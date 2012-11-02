@layout('main')

@section('title')
    Contactez nous - Laravel France
@endsection

@section('content')
    
    <article>
        
        <header>
            <h1>Contact</h1>
        </header>

        <section>

        {{ Form::open(null,null,array('id'=>'contact_form')) }}

            {{ Form::token() }}

            <p>
                {{ Form::label('nom','Nom :') }}
                {{ Form::text('nom') }}
                {{ $errors->first('nom', '<span>:message</span>') }}
            </p>

            <p>
                {{ Form::label('email','Email :') }}
                {{ Form::text('email') }}
                {{ $errors->first('email', '<span>:message</span>') }}
            </p>
            <p>
                {{ Form::label('sujet','Sujet :') }}
                {{ Form::text('sujet') }}
                {{ $errors->first('sujet', '<span>:message</span>') }}
            </p>

            <p>
                {{ Form::label('message', 'Message :')}}<br />
                {{ Form::textarea('message') }}
                {{ $errors->first('message', '<span>:message</span>') }}
            </p>

            <p>
                {{ Form::submit('Envoyer') }}
            </p>
            
        {{ Form::close() }}
        </section>
@endsection