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
        </div>

    	@if($category->topics)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2"><strong>{{ $category->title }}</strong></th>
                    <th class="text-center">Messages</th>
                    <th class="text-center">Vues</th>
                    <th>Dernier message</th>
                </tr>
            </thead>
            <tbody>
                @foreach($category->topics as $topic)
                <tr>
                    <td width="37"></td>
                    <td>
                        <strong>
                            <a href="{{ URL::to_action('forums::topic@index', array($category->id, $category->slug, $topic->id, $topic->slug)) }}">
                                {{ $topic->title }}
                            </a>
                        </strong><br />
                        <small>Par {{ $topic->user->username }} le {{ date('\l\e d/m/Y à H:i:s', strtotime($topic->created_at)) }}</small>
                    </td>
                    <td class="text-center" width="127">{{ $topic->nb_messages }}</td>
                    <td class="text-center" width="127">{{ $topic->nb_views }}</td>
                    <td width="350">
                        <?php $lm = $topic->last_message; ?>

                        @if(!isset($lm[0]))
                            {{ dd($lm) }}
                        @endif
                        <a href="{{ URL::to_action('forums::topic@index', array($category->id, $category->slug, $topic->id, $topic->slug)) }}">
                            {{ date('d/m/Y H:i:s',strtotime($lm[0]->created_at)) }}
                        </a><br />
                        <small>Par {{ $lm[0]->user->username }}</small>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <h3>Aucun topic dans la catégorie <em>{{ $category->title }}</em></h3>
        @endif

        <div class="pull-right">
        </div>

    </div>
</div>
@endsection