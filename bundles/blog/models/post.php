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
        return new \DateTime($this->get_attribute('created_at'));
    }
}