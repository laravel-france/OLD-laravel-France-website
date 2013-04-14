<?php
class Panel_Profile_Controller extends Base_Controller
{

	public function action_index($username)
	{
		$user = User::where_username($username)->first();

		$user_messages = null;
		if (!is_null($user)) {
			$user_messages = Forummessage::with('topic')->where_user_id($user->id)->order_by('created_at','DESC')->take(5)->get();
		}

		return View::make(
			'panel::profile.show',
			compact(
				'user',
				'user_messages'
			)
		);
	}

	public function action_github($username)
	{
		$user = User::where_username($username)->first();
		
		$news = null;
		if (!is_null($user) && $user->github_url) {
			$newReader = new Feedparser($user->github_url . '.atom');
			$news = $newReader->parse(10);
		}

		return View::make(
			'panel::profile.github',
			compact(
				'news'
			)
		);
	}

}
