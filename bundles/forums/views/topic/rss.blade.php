<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
    <channel>
        <title>Forums de Laravel France</title>
        <description>Forums de Laravel France</description>
        <lastBuildDate>{{ date(DATE_RSS) }}</lastBuildDate>
        <link>http://laravel.fr/forums</link>
        @foreach($messages as $message)
        <item>
            <title>{{ $topic->title }}</title>
            <content type="html"><![CDATA[{{ $message->content }}]]></content>
            <pubDate>{{ date(DATE_RSS, strtotime($message->created_at)) }}</pubDate>
            <link>{{ URL::to_action('forums::topic@index', array($topic->slug, $topic->id)); }}?page=last#message{{ $message->id }}</link>
        </item>
        @endforeach
    </channel>
</rss>
