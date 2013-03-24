<?php

class Panel_Password_Controller extends Base_Controller {

	public function action_show()
	{
	    return View::make('panel::panel.password');
	}

	public function action_submit()
	{
	    $inputs = Input::all();


	    if(Auth::user()->isGoodPassword($inputs['current_password'])) {

	    	if(trim($inputs['new_password']) != "") {

	    		if ($inputs['new_password'] === $inputs['confirm_new_password']) {
	    			// save it :)
	    			Auth::user()->password = $inputs['new_password'];
	    			Auth::user()->save();
	    			return Redirect::to('panel/password')->with('passwd_success', 1);
		    	} else {
		    		// mdp non identique
		    		return Redirect::to('panel/password')->with('passwd_error', 3);
	    		}

	    	} else  {
	    		// mdp vide
	    		return Redirect::to('panel/password')->with('passwd_error', 2);
	    	}


	    } else {
	    	// MDP actuel pas bon
	    	return Redirect::to('panel/password')->with('passwd_error', 1);
	    }

	}


}