<?php

class Forums_Home_Controller extends Base_Controller
{

    public function action_index()
    {
        $categories = Forumcategory::getHomePageList();

        return View::make(
            'forums::home.index',
            array(
                'categories' => $categories
            )
        );
    }

    public function action_rss()
    {
        $topics = Forumtopic::order_by('updated_at', 'DESC')->take(20)->get();

        return Response::make(
            View::make('forums::home.rss', array('topics' => $topics)),
            200,
            array('content-type' => 'application/rss+xml')
        );
    }


}
