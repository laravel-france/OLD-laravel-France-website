<?php

class Forums_Home_Controller extends Base_Controller
{

    public function action_index()
    {

    	$categories = Forumcategory::with('last_message')->get();

    	return View::make(
    		'forums::home.index',
    		array(
    			'categories' => $categories
    		)
    	);
    }

}
