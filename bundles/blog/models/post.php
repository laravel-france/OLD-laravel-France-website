<?php

namespace Blog\Models;

class Post extends \Eloquent {

    public function author()
    {
        return $this->belongs_to('Blog\Models\User','author_id');
    }

    public function category()
    {
        return $this->belongs_to('Blog\Models\Category');
    }

    public function get_created_at()
    {
        $date = $this->get_attribute('created_at');
        if (is_a($date, 'DateTime'))
            return $date;
        
        return new \DateTime($date);
    }

    public function get_updated_at()
    {
        $date = $this->get_attribute('updated_at');
        if (is_a($date, 'DateTime'))
            return $date;

        return new \DateTime($date);
    }

    public function get_publicated_at()
    {
        $date = $this->get_attribute('publicated_at');
        if (is_a($date, 'DateTime'))
            return $date;

        return new \DateTime($date);    }

    public function generatePermalink()
    {
        return \URL::to_action('blog::home@resolve', array($this->get_attribute('id')));
    }
}