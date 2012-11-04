<?php

namespace Blog\Models;

class User extends \Eloquent {

    public function posts()
    {
        return $this->has_many('Blog\Models\Post');
    }

}