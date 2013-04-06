<?php

class Panel_Applications_Controller extends Base_Controller {

	public function action_show()
	{
		$args = array();

		if (is_array(Auth::user()->oauth)) {
			foreach (Auth::user()->oauth as $ligne) {				
				$args['have_'.$ligne->provider] = true;
			}
		}

		Session::put('from_url', URL::full());
	    return View::make('panel::panel.applications', $args);
	}
}