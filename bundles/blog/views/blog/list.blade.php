@layout('main')

@section('css')
    @parent
    {{ HTML::style(URL::to_asset('bundles/blog/css/blog.css')) }}
@endsection

@section('title')
    Le blog Laravel France
@endsection

@section('content')

<ul class="breadcrumb">
    <li><a title="Retour à la page d'accueil" href="{{ URL::home() }}"><i class="icon-home"></i></a> <span class="divider">/</span></li>
    <li>Blog</li>
    <li class="pull-right">
        <a target="_blank" href="{{ URL::to_action('blog::home@rss') }}">
            <i class="icon-rss"></i> S'abonner au flux RSS
        </a>
    </li>
</ul>



<div class="row">
    <div class="span12">
        @forelse($posts as $post)
        <div class="single well">

            <div class="p-time">
                <strong class="day">{{ $post->created_at->format('d') }}</strong>
                <strong class="month-year">{{ $post->created_at->format('M') }}<br>{{ $post->created_at->format('Y') }}</strong>
            </div>

            <h1 id="post-{{$post->id}}" class="postTitle">
                <a href="{{ URL::to_action('blog::home@show',array($post->id, $post->slug)) }}" rel="bookmark">
                    {{ $post->title }}
                </a>
            </h1>

            <div class="entry">
                @if($post->intro)
                    {{ MdParser\Markdown($post->intro) }}

                    <div class="pull-right">
                        <a href="{{ URL::to_action('blog::home@show',array($post->id, $post->slug)) }}" rel="bookmark">Lire la suite &gt;&gt;</a>
                    </div>
                @else
                    {{ MdParser\Markdown($post->content) }}
                @endif

            </div>

            <p class="postmetadata"><a href="{{ URL::to_action('blog::home@show',array($post->id, $post->slug)) }}#disqus_thread" data-disqus-identifier="disqus_blog_{{$post->id}}"></a></small></p>

        </div>
        @empty
        <h2>Aucun article</h2>
        @endforelse
    </div>
</div>
@endsection

@section('afterhtml')
<script type="text/javascript">
/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
var disqus_shortname = 'laravelfr'; // required: replace example with your forum shortname

/* * * DON'T EDIT BELOW THIS LINE * * */
(function () {
    var s = document.createElement('script'); s.async = true;
    s.type = 'text/javascript';
    s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
    (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());
</script>
@endsection