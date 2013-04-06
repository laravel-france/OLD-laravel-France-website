<?php

class Forums_Category_Controller extends Base_Controller
{

    public function action_index($slug, $id)
    {
        $topics = Forumtopic::getHomePageList($id);
    	if (!$topics) Event::fire('404');

        $category = Forumcategory::where_id($id)->first(array('id', 'slug', 'title'));

    	return View::make(
    		'forums::category.index',
    		array(
                'category' => $category,
    			'topics' => $topics
    		)
    	);
    }

}
