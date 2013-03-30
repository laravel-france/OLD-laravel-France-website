<?php

class Forummessage extends Eloquent {

	public $includes = array('user');

	public function topic()
	{
		return $this->belongs_to('Forumtopic', 'forumtopic_id');
	}

	public function user()
	{
		return $this->belongs_to('User');
	}

	public function category()
	{
		return $this->belongs_to('Forumcategory', 'forumcategory_id');
	}
}