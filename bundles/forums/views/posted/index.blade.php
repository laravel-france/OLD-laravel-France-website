@layout('main')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/forums/forums.css')) }}
@endsection

@section('title')
    Topics auxquels j'ai participé - Forums de Laravel France
@endsection


@section('content')
<div class="row">
    <div class="span12">
        <ul class="breadcrumb">
            <li><a title="Retour à la page d'accueil" href="{{ URL::home() }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
            <li><a href="{{ URL::to_action('forums::home@index') }}">Forums</a> <span class="divider">/</span></li>
            <li>Topics auxquels j'ai participé</li>
            @include('forums::partials.login_breadcrumb')
        </ul>
    </div>
</div>

<div class="row">
    <div class="span12">
    	@if($topics)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="3"><strong>Topics auxquels j'ai participé</strong></th>
                    <th class="text-center">Catégorie</th>
                    <th class="text-center">Messages</th>
                    <th>Dernier message</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topics as $topic)
                <tr>
                    <td width="1" style="padding:0"><div style="min-height:61px"></div></td>
                    <td width="37" class="ico-read">@if(Forumtopic::isUnread($topic->topic_id))<i class="icon-circle"></i>@else<i class="icon-circle-blank"></i>@endif</td>
                    <td>
                        <strong>
                            <a href="{{ URL::to_action('forums::topic@index', array($topic->topic_slug, $topic->topic_id)) }}">
                                @if($topic->topic_sticky)<i class="icon-flag"></i> @endif{{ $topic->topic_title }}
                            </a>
                        </strong>
                    </td>
                    <td class="text-center">
                        <a href="{{ URL::to_action('forums::category@index', array($topic->cat_slug, $topic->cat_id)) }}">
                            {{ $topic->cat_title }}
                        </a>
                    </td>
                    <td class="text-center" width="127">{{ $topic->topic_nb_messages }}</td>
                    <td width="350">
                        <a href="{{ URL::to_action('forums::topic@index', array($topic->topic_slug, $topic->topic_id)) }}?page=last#message{{ $topic->last_message_id }}">
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
            <h3>Vous n'avez participé à aucun topic</h3>
        @endif
    </div>
</div>
@endsection