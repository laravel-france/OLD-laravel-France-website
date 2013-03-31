<?php

class Forumcategory extends Eloquent {

	public function topics()
	{
		return $this->has_many('Forumtopic')->order_by('updated_at', 'desc');
	}

    public function messages()
    {
    	return $this->has_many('Forummessage');
    }

    public function last_message()
    {
    	return $this->messages()->with('user')->order_by('created_at', 'desc')->take(1);
    }
}