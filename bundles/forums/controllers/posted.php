<?php

class Forums_Posted_Controller extends Base_Controller
{

    public function action_index()
    {
        if(Auth::guest()) return Event::first('404');

        $topics = Forumtopic::getPosted();

        return View::make(
            'forums::posted.index',
            array(
                'topics' => $topics
            )
        );
    }
}
