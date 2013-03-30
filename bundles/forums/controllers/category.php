<?php

class Forums_Category_Controller extends Base_Controller
{

    public function action_index($id, $slug)
    {
    	$category = Forumcategory::find($id)->with('topics');
    	if (!$category) Event::fire('404');

    	return View::make(
    		'forums::category.index',
    		array(
    			'category' => $category
    		)
    	);
    }

}
