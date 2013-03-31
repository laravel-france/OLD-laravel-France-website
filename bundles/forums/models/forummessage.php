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

	public function save()
	{
		$isNew = !$this->exists;

		$this->user_id = Auth::user()->id;

		parent::save();

		if ($isNew) {
			$this->category->nb_posts++;
			$this->category->save();

			$this->topic->nb_messages++;

			Auth::user()->nb_messages++;
			Auth::user()->save();
		}

		$this->topic->updated_at = $this->updated_at;
		$this->topic->save();

		return $this;
	}
}