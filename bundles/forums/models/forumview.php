<?php

class Forumview extends Eloquent {

	public function topic()
	{
		return $this->has_one('Forumtopic');
	}

    public function user()
    {
    	return $this->has_one('User');
    }

}