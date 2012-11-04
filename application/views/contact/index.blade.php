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

        {{ Form::open(null,null,array('id'=>'contact_form', 'class'=>'form-horizontal')) }}

            {{ Form::token() }}

            <div class="control-group @if($errors->has('nom'))error@endif">
                {{ Form::label('nom','Nom* :',array('class'=>'control-label')) }}
                <div class="controls">
                {{ Form::text('nom') }}
                {{ $errors->first('nom', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group @if($errors->has('email'))error@endif">
                {{ Form::label('email','Email* :',array('class'=>'control-label')) }}
                <div class="controls">
                {{ Form::text('email') }}
                {{ $errors->first('email', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group @if($errors->has('sujet'))error@endif">
                {{ Form::label('sujet','Sujet :',array('class'=>'control-label')) }}
                <div class="controls">
                {{ Form::text('sujet') }}
                {{ $errors->first('sujet', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group @if($errors->has('message'))error@endif">
                {{ Form::label('message', 'Message* :',array('class'=>'control-label'))}}
                <div class="controls">
                {{ Form::textarea('message',null,array('class'=>'span8')) }}
                {{ $errors->first('message', '<span class="help-inline">:message</span>') }}
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                {{ Form::submit('Envoyer',array('class'=>'btn btn-primary')) }}
                </div>
            </div>
            
        {{ Form::close() }}
        </section>
@endsection