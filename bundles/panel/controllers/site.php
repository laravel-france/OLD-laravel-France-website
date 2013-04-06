<?php

use Verify\Models\Role;

class Panel_Site_Controller extends Base_Controller {

	public function action_listusers()
	{
	    return View::make('panel::users.list')
	    	->with_users(User::all());
	}


	public function action_editusers($user_id)
	{
	    return View::make('panel::users.edit')
	    	->with_cUser(User::find($user_id))
	    	->with_roles(Role::order_by('level', 'DESC')->order_by('name', 'asc')->get());
	}

	public function action_updateusers($user_id)
	{
		$user = User::find($user_id);
		$user->accessible(array('username', 'email', 'verified', 'disabled', 'deleted'));
		$user->fill(Input::all())
			->save();


	    return Redirect::to_action('panel::site@editusers', array($user_id))->with('success', '1');
	}

	public function action_updateuserpassword($user_id)
	{
		$user = User::find($user_id);
	    $inputs = Input::all();

	    $user = User::find($user_id);
		$url = URL::to_action('panel::site@editusers', array($user_id)) . '#password';

    	if(trim($inputs['new_password']) != "") {

    		if ($inputs['new_password'] === $inputs['confirm_new_password']) {
    			$user->password = $inputs['new_password'];
    			$user->save();
    			return Redirect::to($url)->with('passwd_success', 1);
	    	} else {
	    		// mdp non identique
	    		return Redirect::to($url)->with('passwd_error', 3);
    		}

    	} else  {
    		// mdp vide
    		return Redirect::to($url)->with('passwd_error', 2);
    	}
	}

	public function action_updateuserroles($user_id)
	{
		$user = User::find($user_id);
		$user->roles()->sync(Input::get('roles'));

		$url = URL::to_action('panel::site@editusers', array($user_id)) . '#roles';
	    return Redirect::to($url)->with('role_success', '1');
	}

	public function action_removeuser($user_id)
	{
		$user = User::find($user_id);
        if($user) $user->delete();

        return Redirect::back();
	}

	public function action_listroles()
	{
	    return View::make('panel::users.roles')->with_roles(Role::order_by('level', 'DESC')->order_by('name', 'asc')->get());
	}

	public function action_newrole()
	{
		Role::create(Input::all());
		return '';
	}

}