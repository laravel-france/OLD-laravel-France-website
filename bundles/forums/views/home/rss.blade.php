<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
    <channel>
        <title>Forums de Laravel France</title>
        <description>Forums de Laravel France</description>
        <lastBuildDate>{{ date(DATE_RSS) }}</lastBuildDate>
        <link>http://laravel.fr/forums</link>
        @foreach($topics as $topic)
        <item>
            <title>{{ $topic->title }}</title>
            <pubDate>{{ date(DATE_RSS, strtotime($topic->updated_at)) }}</pubDate>
            <link>{{ URL::to_action('forums::topic@index', array($topic->slug, $topic->id)); }}</link>
        </item>
        @endforeach
    </channel>
</rss>
