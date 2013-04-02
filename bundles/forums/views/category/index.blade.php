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
            <li class="pull-right">Page 1</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="span12">

        <div class="pull-right">
            @include('forums::partials.new_topic')
        </div>

    	@if($category->topics)
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
                @foreach($category->topics as $topic)
                <tr>
                    <td width="1" style="padding:0"><div style="min-height:61px"></div></td>
                    <td width="37" class="ico-read">@if($topic->isUnread())<i class="icon-circle"></i>@else<i class="icon-circle-blank"></i>@endif</td>
                    <td>
                        <strong>
                            <a href="{{ URL::to_action('forums::topic@index', array($category->slug, $topic->slug)) }}">
                                {{ $topic->title }}
                            </a>
                        </strong><br />
                        <small>Par {{ $topic->user->username }} le {{ date('\l\e d/m/Y à H:i:s', strtotime($topic->created_at)) }}</small>
                    </td>
                    <td class="text-center" width="127">{{ $topic->nb_messages }}</td>
                    <td class="text-center" width="127">{{ $topic->nb_views }}</td>
                    <td width="350">
                        <?php $lm = $topic->last_message; ?>
                        <a href="{{ URL::to_action('forums::topic@index', array($category->slug, $topic->slug)) }}#message{{ $lm[0]->id }}">
                            {{ date('d/m/Y H:i:s',strtotime($lm[0]->created_at)) }}
                        </a><br />
                        <small>Par {{ $lm[0]->user->username }}</small>
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