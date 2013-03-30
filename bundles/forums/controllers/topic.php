<?php

class Forums_Topic_Controller extends Base_Controller
{

    public function action_index($category_id, $catslug, $topic_id, $topic_slug)
    {

        $category = Forumcategory::find($category_id);
        if (!$category) Event::fire('404');

        $topic = Forumtopic::find($topic_id);
        if (!$topic) Event::fire('404');

        $messages = $topic->messages;

    	return View::make(
    		'forums::topic.index',
    		array(
    			'category' => $category,
                'topic' => $topic,
                'messages' => $messages,
    		)
    	);
    }

}
