<?php

class Forums_Category_Controller extends Base_Controller
{

    public function action_index($slug)
    {
    	$category = Forumcategory::findBySlug($slug)->with('ordered_topics');
    	if (!$category) Event::fire('404');

    	return View::make(
    		'forums::category.index',
    		array(
    			'category' => $category
    		)
    	);
    }

}
