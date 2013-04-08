<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
    <channel>
        <title>Laravel.Fr</title>
        <description>Laravel France : le blog</description>
        <lastBuildDate>{{ date(DATE_RSS) }}</lastBuildDate>
        <link>http://laravel.fr/blog</link>
        @foreach($posts as $post)
        <item>
            <title>{{ $post->title }}</title>
            <description>{{ $post->content }}</description>
            <pubDate>{{ $post->publicated_at->format(DATE_RSS) }}</pubDate>
            <link>{{ URL::to_action('blog::home@resolve', array($post->id)); }}</link>
        </item>
        @endforeach
    </channel>
</rss>
