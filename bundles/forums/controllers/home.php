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

}
