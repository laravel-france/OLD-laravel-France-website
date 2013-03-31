<?php

class Forums_Topic_Controller extends Base_Controller
{

    public function action_index($category_id, $catslug, $topic_id, $topic_slug)
    {

        $category = Forumcategory::find($category_id);
        if (!$category) Event::fire('404');

        $topic = Forumtopic::find($topic_id);
        if (!$topic) Event::fire('404');

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

    public function action_reply($category_id, $catslug, $topic_id, $topic_slug)
    {
        $category = Forumcategory::find($category_id);
        if (!$category) Event::fire('404');

        $topic = Forumtopic::find($topic_id);
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

    public function action_postreply($category_id, $catslug, $topic_id, $topic_slug)
    {
        $category = Forumcategory::find($category_id);
        if (!$category) Event::fire('404');

        $topic = Forumtopic::find($topic_id);
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
        $message->forumtopic_id = $topic_id;
        $message->forumcategory_id = $category_id;

        $message->save();


        return Redirect::to_action('forums::topic@index', compact('category_id', 'catslug', 'topic_id', 'topic_slug'));
    }

    public function action_create($category_id, $catslug)
    {
        $category = Forumcategory::find($category_id);
        if (!$category) Event::fire('404');


        return View::make(
            'forums::topic.create',
            array(
                'category' => $category
            )
        );
    }

    public function action_postcreate($category_id, $catslug)
    {
        $category = Forumcategory::find($category_id);
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
        $topic->forumcategory_id = $category_id;

        $message = new Forummessage();
        $message->content = BBCodeParser::parse($content);
        $message->content_bbcode = $content;

        $topic->saveWithMessage($message);


        $topic_id = $topic->id;
        $topic_idslug = $topic->slug;

        return Redirect::to_action('forums::topic@index', compact('category_id', 'catslug', 'topic_id', 'topic_slug'));
    }


}
