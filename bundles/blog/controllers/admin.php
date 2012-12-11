<?php

class Blog_Admin_Controller extends \Base_Controller {


    public function action_index() {

        $cntBlogPost = \Blog\Models\Post::count();

        return View::make('blog::admin.index')
            ->with('nbPost', $cntBlogPost);
    }

}