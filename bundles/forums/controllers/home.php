<?php

class Forums_Home_Controller extends Base_Controller
{

    public function action_index()
    {

    	$categories = Forumcategory::order_by('order', 'asc')->get();

    	return View::make(
    		'forums::home.index',
    		array(
    			'categories' => $categories
    		)
    	);
    }

}
