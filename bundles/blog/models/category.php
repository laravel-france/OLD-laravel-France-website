<?php

namespace Blog\Models;

class Category extends \Eloquent {

    public function posts()
    {
        return $this->has_many('Blog\Models\Post');
    }
}