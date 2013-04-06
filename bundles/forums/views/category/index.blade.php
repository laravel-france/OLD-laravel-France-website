@layout('main')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/forums/forums.css')) }}
@endsection

@section('title')
    {{ $category->title }} - Forums de Laravel France
@endsection

@section('content')

<div class="row">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a title="Retour à la page d'accueil" href="{{ URL::home() }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
            <li><a href="{{ URL::to_action('forums::home@index') }}">Forums</a> <span class="divider">/</span></li>
            <li>{{ $category->title }}</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="span6">
        <div class="pull-left">
            {{ $pagination }}
        </div>
    </div>
    <div class="span6">
        <div class="pull-right">
            @include('forums::partials.new_topic')
        </div>
    </div>
</div>

<div class="row">
    <div class="span12">
    	@if($topics)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="3"><strong>{{ $category->title }}</strong></th>
                    <th class="text-center">Messages</th>
                    <th class="text-center">Vues</th>
                    <th>Dernier message</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topics as $topic)
                <tr>
                    <td width="1" style="padding:0"><div style="min-height:61px"></div></td>
                    <td width="37" class="ico-read">@if(Forumtopic::isUnread($topic->id))<i class="icon-circle"></i>@else<i class="icon-circle-blank"></i>@endif</td>
                    <td>
                        <strong>
                            <a href="{{ URL::to_action('forums::topic@index', array($topic->slug, $topic->id)) }}">
                                @if($topic->sticky)<i class="icon-flag"></i> @endif{{ $topic->title }}
                            </a>
                        </strong><br />
                        <small>Par {{ $topic->topic_username }} le {{ date('\l\e d/m/Y à H:i:s', strtotime($topic->created_at)) }}</small>
                    </td>
                    <td class="text-center" width="127">{{ $topic->nb_messages }}</td>
                    <td class="text-center" width="127">{{ $topic->nb_views }}</td>
                    <td width="350">
                        <a href="{{ URL::to_action('forums::topic@index', array($topic->slug, $topic->id)) }}?page=last#message{{ $topic->last_message_id }}">
                            {{ date('d/m/Y H:i:s',strtotime($topic->last_message_date)) }}
                        </a><br />
                        <small>Par {{ $topic->last_message_username }}</small>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            <strong>Légende :</strong>
            <p class="ico-read">
                <i class="icon-circle"></i> : Messages non lus<br />
                <i class="icon-circle-blank"></i> : Messages lus
            </p>
        </div>


        @else
            <h3>Aucun topic dans la catégorie <em>{{ $category->title }}</em></h3>
        @endif

        <div class="pull-right">
            @include('forums::partials.new_topic')
        </div>

    </div>
</div>
@endsection