<?php

class Forumview extends Eloquent {

	public function topic()
	{
        $pastFromTenDays = value(Config::get('forums::forums.mark_as_read_after'));
		return $this->has_one('Forumtopic')->where('updated_at', '<=', date('Y-m-d H:i:s', $pastFromTenDays));
	}

    public function user()
    {
    	return $this->has_one('User');
    }

}