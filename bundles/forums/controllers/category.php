<?php

class Forums_Category_Controller extends Base_Controller
{

    public function action_index($slug, $id)
    {
    	$category = Forumcategory::find($id)->with('ordered_topics');
    	if (!$category) Event::fire('404');

    	return View::make(
    		'forums::category.index',
    		array(
    			'category' => $category
    		)
    	);
    }

}
