<?php

class Forumtopic extends Eloquent {

	public $includes = array('user');

	public function user()
	{
		return $this->belongs_to('User');
	}

	public function category()
	{
		return $this->belongs_to('Forumcategory');
	}

    public function messages()
    {
    	return $this->has_many('Forummessage')->with('user')->order_by('updated_at', 'asc');
    }

    public function last_message()
    {
    	return $this->messages()->order_by('updated_at', 'desc')->take(1);
    }
}