<?php

class Forums_Topic_Controller extends Base_Controller
{

    public function action_index($catslug, $topic_slug)
    {

        $category = Forumcategory::findBySlug($catslug);
        if (is_null($category)) return Event::first('404');

        $topic = Forumtopic::findBySlug($topic_slug);
        if (is_null($topic)) return Event::first('404');

        $topic->view();

        $messages = $topic->ordered_messages;

        return View::make(
            'forums::topic.index',
            array(
                'category' => $category,
                'topic' => $topic,
                'messages' => $messages,
            )
        );
    }

    public function action_reply($catslug, $topic_slug)
    {
        $category = Forumcategory::findBySlug($catslug);
        if (!$category) Event::fire('404');

        $topic = Forumtopic::findBySlug($topic_slug);
        if (!$topic) Event::fire('404');

        $messages = $topic->messages()->order_by('created_at', 'DESC')->take(5)->get();

        return View::make(
            'forums::topic.reply',
            array(
                'category' => $category,
                'topic' => $topic,
                'messages' => $messages,
            )
        );
    }

    public function action_postreply($catslug, $topic_slug)
    {
        $category = Forumcategory::findBySlug($catslug);
        if (!$category) Event::fire('404');

        $topic = Forumtopic::findBySlug($topic_slug);
        if (!$topic) Event::fire('404');

        $rules = array(
            'content' => 'required|min:2'
        );


        $content = trim(Input::get('content'));

        $validator = Validator::make(compact('content'), $rules);
        if ($validator->fails()) {
            return Redirect::back()->with_errors($validator)->with_input();
        }

        $message = new Forummessage();

        $message->content = BBCodeParser::parse($content);
        $message->content_bbcode = $content;
        $message->forumtopic_id = $topic->id;
        $message->forumcategory_id = $category->id;

        $message->save();

        $url = URL::to_action('forums::topic@index', compact('catslug', 'topic_slug')).'#message'.$message->id;        
        return Redirect::to($url);
    }

    public function action_create($catslug)
    {
        $category = Forumcategory::findBySlug($catslug);
        if (!$category) Event::fire('404');


        return View::make(
            'forums::topic.create',
            array(
                'category' => $category
            )
        );
    }

    public function action_postcreate($catslug)
    {
        $category = Forumcategory::findBySlug($catslug);
        if (!$category) Event::fire('404');

        $rules = array(
            'title' => 'required|min:2',
            'content' => 'required|min:30'
        );

        $title = trim(Input::get('title'));
        $content = trim(Input::get('content'));

        $validator = Validator::make(compact('title', 'content'), $rules);
        if ($validator->fails()) {
            return Redirect::back()->with_errors($validator)->with_input();
        }

        $topic = new Forumtopic();
        $topic->title = $title;
        $topic->slug = Str::slug($title);
        $topic->forumcategory_id = $category->id;

        $message = new Forummessage();
        $message->content = BBCodeParser::parse($content);
        $message->content_bbcode = $content;

        $topic->saveWithMessage($message);


        $topic_id = $topic->id;
        $topic_slug = $topic->slug;

        $url = URL::to_action('forums::topic@index', compact('catslug', 'topic_slug')).'#message'.$message->id;        
        return Redirect::to($url);
    }


}
