<?php

class Panel_Avatar_Controller extends Base_Controller {


	public function action_show()
	{
	    return View::make('panel::panel.avatar');
	}

	public function action_submit()
	{
	    $email = Input::get('email');

	    $user = User::where_email($email)->first('id');

	    if($user != null && $user->id != Auth::user()->id) {
	    	return Response::make(json_encode(array('message' => 'Adresse email déjà attribuée')), 400);
	    } elseif($user != null && $user->id == Auth::user()->id) {
	    	return Response::make(json_encode(array('message' => 'Cette adresse email est déjà la votre')), 200);
	    }

	    $validator = Validator::make(array('email' => $email), array('email' => 'email|required'));

	    if ($validator->fails()) {
	    	return Response::make(json_encode(array('message' => 'Adresse email invalide')), 400);
	    }


	    Auth::user()->email = trim($email);
	    Auth::user()->save();
    	return Response::make(json_encode(array('message' => 'Adresse email mise à jour')), 200);
	}


}