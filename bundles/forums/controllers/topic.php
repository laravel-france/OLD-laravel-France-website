<?php

class Forums_Topic_Controller extends Base_Controller
{

    public function action_index($topic_slug, $topic_id)
    {

        $topic = Forumtopic::find($topic_id);
        if (is_null($topic)) return Event::first('404');

        $category = $topic->category;

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

    public function action_reply($topic_slug, $topic_id)
    {
        $topic = Forumtopic::find($topic_id);
        if (is_null($topic)) return Event::first('404');

        $category = $topic->category;

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

    public function action_postreply($topic_slug, $topic_id)
    {
        $topic = Forumtopic::find($topic_id);
        if (is_null($topic)) return Event::first('404');

        $category = $topic->category;

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

        $url = URL::to_action('forums::topic@index', compact('topic_slug', 'topic_id')).'#message'.$message->id;        
        return Redirect::to($url);
    }

    public function action_create($catslug, $catid)
    {
        $category = Forumcategory::find($catid);
        if (is_null($category)) return Event::first('404');

        return View::make(
            'forums::topic.create',
            array(
                'category' => $category
            )
        );
    }

    public function action_postcreate($catslug, $catid)
    {
        $category = Forumcategory::find($catid);
        if (is_null($category)) return Event::first('404');

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

        $url = URL::to_action('forums::topic@index', compact('topic_slug', 'topic_id')).'#message'.$message->id;        
        return Redirect::to($url);
    }

    public function action_toggle_sticky($topic_slug, $topic_id)
    {
        $topic = Forumtopic::find($topic_id);
        if (is_null($topic)) return Event::first('404');

        $topic->toggleSticky();

        return Redirect::back();
    }

    public function action_edit($topic_slug, $topic_id, $message_id)
    {
        $topic = Forumtopic::find($topic_id);
        if (is_null($topic)) return Event::first('404');

        $category = $topic->category;

        $message = Forummessage::find($message_id);
        if (is_null($message)) return Event::first('404');

        if ($message->user->id != Auth::user()->id && !Auth::user()->is('Forumer'))
            return Event::first('404');

        return View::make(
            'forums::topic.edit',
            array(
                'category' => $category,
                'topic' => $topic,
                'message' => $message,
            )
        );
    }

    public function action_postedit($topic_slug, $topic_id, $message_id)
    {
        $topic = Forumtopic::find($topic_id);
        if (is_null($topic)) return Event::first('404');

        $category = $topic->category;

        $message = Forummessage::find($message_id);
        if (is_null($message)) return Event::first('404');

        if ($message->user->id != Auth::user()->id && !Auth::user()->is('Forumer'))
            return Event::first('404');

        $rules = array(
            'content' => 'required|min:30'
        );
        $content = trim(Input::get('content'));
        $toValidate = compact('content');


        $editTitle = false;
        if ($topic->messages[0]->id == $message->id && trim(Input::get('title')) != $topic->title) {
            $editTitle = true;
            $rules['title'] = 'required|min:2';
            $title = trim(Input::get('title'));
            $toValidate['title'] = $title;
        }



        $validator = Validator::make($toValidate, $rules);
        if ($validator->fails()) {
            return Redirect::back()->with_errors($validator)->with_input();
        }

        if ($editTitle) {
            $topic->title = $toValidate['title'];
            $topic->slug = Str::slug($toValidate['title']);
            $originalSlug = $topic->slug;
            $incSlug = 0;
            
            do {
                try {
                    $topic->save();
                    $incSlug = 0;
                } catch(Exception $e) {
                    if ($e->getCode() == 23000) {
                        $incSlug++;
                    }
                    $topic->slug = $originalSlug.'-'.$incSlug;
                }
            } while($incSlug != 0);
        }
       
        $message->content = BBCodeParser::parse($content);
        $message->content_bbcode = $content;

        $message->save();
        $topic->touch();

        $topic_id = $topic->id;
        $topic_slug = $topic->slug;

        $url = URL::to_action('forums::topic@index', compact('topic_slug', 'topic_id')).'#message'.$message->id;        
        return Redirect::to($url);
    }
}
