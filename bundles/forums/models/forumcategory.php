<?php

class Forumcategory extends Eloquent {


    public static function getHomePageList()
    {
        return DB::query('SELECT 
            forumcategories.id as id,
            forumcategories.title as title,
            forumcategories.slug as slug,
            forumcategories.desc as description,
            forumcategories.nb_topics as nb_topics,
            forumcategories.nb_posts as nb_posts,
            fm.id as last_message_id,
            fm.created_at as last_message_date,
            forumtopics.id as last_message_topic_id,
            forumtopics.slug as last_message_topic_slug,
            forumtopics.title as last_message_topic_title,
            users.username as last_message_username
        FROM forumcategories
        LEFT OUTER JOIN (SELECT forummessages.id, forummessages.user_id, forummessages.forumtopic_id, forummessages.forumcategory_id, forummessages.created_at FROM forummessages ORDER BY forummessages.created_at DESC) as fm
        ON fm.forumcategory_id = forumcategories.id
        LEFT OUTER JOIN forumtopics ON fm.forumtopic_id = forumtopics.id
        LEFT OUTER JOIN users ON fm.user_id = users.id
        GROUP BY fm.forumcategory_id
        ORDER BY
            forumcategories.order ASC');

    }

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

    public static function isUnread($id)
    {
        $cat = static::where_id($id)->first('id');
        return $cat->_isUnread();
    }

    private function _isUnread()
    {
        if(Auth::guest()) return false;
        $pastFromTenDays = value(Config::get('forums::forums.mark_as_read_after'));

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

