<?php

class Forumcategory extends Eloquent {

    public static function findBySlug($slug)
    {
        return static::where('slug', '=', $slug)->first();
    }

    public function topics()
    {
        return $this->has_many('Forumtopic')->order_by('updated_at', 'desc');
    }

    public function ordered_topics()
    {
        return $this->has_many('Forumtopic')->order_by('sticky', 'desc')->order_by('updated_at', 'desc');
    }
    

    public function messages()
    {
    	return $this->has_many('Forummessage');
    }

    public function last_message()
    {
    	return $this->messages()->with('user')->order_by('created_at', 'desc')->take(1);
    }

    public function isUnread()
    {
        if(Auth::guest()) return false;
        $pastFromTenDays = time() - ( 10*24*60*60 );

        if (!IoC::registered('topicsview'))
        {
            IoC::singleton('topicsview', function() use ($pastFromTenDays)
            {
                return Forumview::where('updated_at', '>=', date('Y-m-d H:i:s', $pastFromTenDays))->where('user_id', '=', Auth::user()->id)->lists('topic_id');
            });
        }

        $tv = IoC::resolve('topicsview');
        $nb = count($tv);

        $view = Forumtopic::where('forumcategory_id', '=', $this->id)->where('updated_at', '>=', date('Y-m-d H:i:s', $pastFromTenDays));

        if($nb > 0)
            $view = $view->where_not_in('id', $tv);
        $view = $view->count();

        if($nb == 0 && $view > 0) return true;

        if ($view > 0) return true;
        return false;
    }
}

