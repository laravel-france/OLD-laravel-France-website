@layout('blog::admin.layout')

@section('admincontent')
    <h3>Nouvel article</h3>

    {{ Form::open(null,null,array('id'=>'new_post_form', 'class'=>'form')) }}

    {{ Form::token() }}

    {{ Form::hidden('author_id', Auth::user()->id) }}

    <div class="control-group @if($errors->has('title'))error@endif">
        {{ Form::label('title','Titre* :',array('class'=>'control-label')) }}
        <div class="controls">
        {{ Form::text('title', Input::old('title')) }}
        {{ $errors->first('title', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group @if($errors->has('slug'))error@endif">
        {{ Form::label('slug','Slug* :',array('class'=>'control-label')) }}
        <div class="controls">
        {{ Form::text('slug', Input::old('slug')) }}
        {{ $errors->first('slug', '<span class="help-inline">:message</span>') }}
        </div>
    </div>

    <div class="control-group @if($errors->has('content'))error@endif">
        {{ Form::label('content','Contenu* :',array('class'=>'control-label')) }}
        <div class="controls">
        {{ Form::textarea('content', Input::old('content') ,array('class'=>'span9')) }}
        {{ $errors->first('content', '<span class="help-inline">Veuillez insérer un message</span>') }}
        </div>
    </div>

    <div class="control-group @if($errors->has('publicated_at'))error@endif">
        {{ Form::label('publicated_at','Date de publication* :',array('class'=>'control-label')) }}
        <div class="controls">
        <div class="input-append">
            <input type="date" name="publicated_at_date" id="publicated_at_date" value="{{ date('Y-m-d') }}" />
            <input type="time" name="publicated_at_time" id="publicated_at_time" value="{{ date('H:i') }}" style="width: auto;" />
            <button class="btn btn-success" type="submit" onclick="setPublicatedAt(); return false;">Maintenant</button>
        </div>
        {{ $errors->first('publicated_at', '<span class="help-inline">:message</span>') }}
    </div>

    <div class="control-group">
        <div class="controls">
        {{ Form::submit('Envoyer',array('class'=>'btn btn-primary')) }}
        </div>
    </div>
    
{{ Form::close() }}
@endsection


@section('javascript')
    <script>
    function setPublicatedAt()
    {
        var now = new Date();
        var month = (now.getMonth() + 1);               
        var day = now.getDate();
        if(month < 10) 
            month = "0" + month;
        if(day < 10) 
            day = "0" + day;
        var today = now.getFullYear() + '-' + month + '-' + day;
        $('#publicated_at_date').val(today);


        var hour = now.getHours();
        var min = now.getMinutes();
        var time = hour+':'+min;
        $('#publicated_at_time').val(time);
    }
    </script>
@endsection