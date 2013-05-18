<?php

class Forumtopic extends Eloquent {

	//public $includes = array('user');

    public static function getHomePageList($category_id)
    {

        $total = static::where('forumtopics.forumcategory_id', '=', $category_id)->count();
        $per_page = Config::get('forums::forums.topics_per_page');
        $page = Paginator::page($total, $per_page);


        $topics = DB::query('SELECT 
            forumtopics.id as id,
            forumtopics.title as title,
            forumtopics.slug as slug,
            forumtopics.nb_messages as nb_messages,
            forumtopics.nb_views as nb_views,
            forumtopics.sticky as sticky,
            forumtopics.created_at as created_at,
            topicusers.username as topic_username,
            fm.id as last_message_id,
            fm.created_at as last_message_date,
            users.username as last_message_username
        FROM forumtopics
        JOIN (SELECT forummessages.id, forummessages.user_id, forummessages.forumtopic_id, forummessages.created_at FROM forummessages ORDER BY forummessages.created_at DESC) as fm
        ON fm.forumtopic_id = forumtopics.id
        JOIN users ON fm.user_id = users.id
        JOIN users as topicusers ON forumtopics.user_id = topicusers.id
        WHERE forumtopics.forumcategory_id = ? 
        GROUP BY fm.forumtopic_id
        ORDER BY forumtopics.sticky DESC, fm.created_at DESC
        LIMIT '.(($page-1)*$per_page).', '.$per_page, array($category_id));

        return Paginator::make($topics, $total, $per_page);
    }

    public static function getPosted()
    {
        return DB::query('SELECT
            forumcategories.id as cat_id,
            forumcategories.title as cat_title,
            forumcategories.slug as cat_slug,
            forumtopics.id as topic_id,
            forumtopics.title as topic_title,
            forumtopics.slug as topic_slug,
            forumtopics.sticky as topic_sticky,
            forumtopics.nb_messages as topic_nb_messages,
            fm.id as last_message_id,
            fm.created_at as last_message_date,
            users.username as last_message_username
        FROM forumtopics
        JOIN (SELECT forummessages.id, forummessages.user_id, forummessages.forumtopic_id, forummessages.created_at FROM forummessages ORDER BY forummessages.created_at DESC) as fm
            ON fm.forumtopic_id = forumtopics.id
        JOIN forumcategories ON forumtopics.forumcategory_id = forumcategories.id
        JOIN users ON fm.user_id = users.id
        WHERE forumtopics.id IN (SELECT forumtopic_id FROM forummessages WHERE user_id = ? GROUP BY forumtopic_id ORDER BY created_at DESC)
        GROUP BY fm.forumtopic_id
        ORDER BY fm.created_at DESC
        LIMIT 20', array(Auth::user()->id));
    }

    public static function findBySlug($slug)
    {
        return static::where('slug', '=', $slug)->first();
    }

    public function view($andMarkAsRead = false)
    {
        $this->nb_views++;
        static::where('id', '=', $this->id)->update(array('nb_views' => ($this->nb_views)));

        if(Auth::guest()) return;

        if($andMarkAsRead) {
            $fv = Forumview::where('topic_id', '=', $this->id)->where('user_id', '=', Auth::user()->id)->first();
            if (!is_null($fv)) {
                $fv->touch();
            } else {
                Forumview::create(array(
                    'topic_id' => $this->id,
                    'user_id' => Auth::user()->id
                ));
            }
        }
    }

	public function user()
	{
		return $this->belongs_to('User');
	}

	public function category()
	{
		return $this->belongs_to('Forumcategory', 'forumcategory_id');
	}

    public function messages()
    {
    	return $this->has_many('Forummessage')->with('user');
    }

    public function ordered_messages()
    {
    	return $this->messages()->order_by('created_at', 'asc');
    }

    public function last_message()
    {
    	return $this->messages()->order_by('updated_at', 'desc')->take(1);
    }

    public function saveWithMessage(Forummessage $message)
    {
        $this->user_id = Auth::user()->id;

        $incSlug = 0;
        $originalSlug = $this->slug;

        $this->sticky = false;
        do {

            try {
                parent::save();
                $incSlug = 0;
            } catch(Exception $e) {
                if ($e->getCode() == 23000) {
                    $incSlug++;
                }
                $this->slug = $originalSlug.'-'.$incSlug;
            }

        

        } while($incSlug != 0);

        $this->category->nb_topics++;
        $this->category->save();

        $message->forumtopic_id = $this->id;
        $message->forumcategory_id = $this->forumcategory_id;
        $message->save();

        return $this;
    }

    public static function isUnread($id)
    {
        $obj = static::where_id($id)->first(array('id', 'updated_at'));
        return $obj->_isUnread();
    }

    public function _isUnread()
    {
        if(Auth::guest()) return false;
        $markAsReadAfter = value(Config::get('forums::forums.mark_as_read_after'));

        // is the topic > delay, then return false;
        if(strtotime($this->updated_at) < $markAsReadAfter) return false;

        if (!IoC::registered('topicsview'))
        {
            IoC::singleton('topicsview', function() use ($markAsReadAfter)
            {
                return Forumview::where('updated_at', '>=', date('Y-m-d H:i:s', $markAsReadAfter))->where('user_id', '=', Auth::user()->id)->lists('topic_id');
            });
        }

        if(array_search($this->id, IoC::resolve('topicsview')) !== false) return false;
        return true;
    }


    public function toggleSticky()
    {
        $this->sticky = !((bool)$this->sticky);
        $this->save();
    }

}