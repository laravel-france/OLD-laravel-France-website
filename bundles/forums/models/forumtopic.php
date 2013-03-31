<?php

class Forumtopic extends Eloquent {

	public $includes = array('user');


    public static function findBySlug($slug)
    {
        return static::where('slug', '=', $slug)->first();
    }

    public function view()
    {
        $this->nb_views++;
        static::where('id', '=', $this->id)->update(array('nb_views' => ($this->nb_views)));
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

        do {

            try {
                parent::save();
                $incSlug = 0;
            } catch(Exception $e) {
                if ($e->getCode() == 23000) {
                    $incSlug++;
                }
            }

        $this->slug = $originalSlug.'-'.$incSlug;

        } while($incSlug != 0);

        $this->category->nb_topics++;
        $this->category->save();

        $message->forumtopic_id = $this->id;
        $message->forumcategory_id = $this->forumcategory_id;
        $message->save();

        return $this;
    }
}