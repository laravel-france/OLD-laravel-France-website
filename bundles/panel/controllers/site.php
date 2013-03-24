<?php

class Panel_Site_Controller extends Base_Controller {

	public function action_listusers()
	{
	    return View::make('panel::users.list')
	    	->with_users(User::all());
	}


	public function action_editusers($user_id)
	{
	    return View::make('panel::users.edit')
	    	->with_cUser(User::find($user_id));
	}

	public function action_updateusers($user_id)
	{
		$user = User::find($user_id)->fill(Input::all())->save();


	    return Redirect::to_action('panel::site@editusers', array($user_id))->with('success', '1');
	}

}