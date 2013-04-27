<?php

class Forums_Category_Controller extends Base_Controller
{

    public function action_index($slug, $id)
    {
        $topics = Forumtopic::getHomePageList($id);
        if (!$topics) return Event::first('404');

        $pagination = $topics->links();
        $topics = $topics->results;

        $category = Forumcategory::where_id($id)->first(array('id', 'slug', 'title'));

        return View::make(
            'forums::category.index',
            array(
                'category' => $category,
                'topics' => $topics,
                'pagination' => $pagination
            )
        );
    }

    public function action_rss($slug, $id)
    {
        $topics = Forumtopic::where_forumcategory_id($id)->order_by('updated_at', 'DESC')->take(20)->get();

        return Response::make(
            View::make('forums::home.rss', array('topics' => $topics)),
            200,
            array('content-type' => 'application/rss+xml')
        );
    }

}
