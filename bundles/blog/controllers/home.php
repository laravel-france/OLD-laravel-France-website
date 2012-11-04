<?php

use Blog\Models\Post;

class Blog_Home_Controller extends Base_Controller
{

    public function action_index()
    {
        if ($posts = Post::with(array('author','category'))->order_by('created_at','desc')->paginate(10)) {
            
            return View::make('Blog::blog.list')
                ->with('posts',$posts->results)
                ->with('pagination',$posts->links());


        } else {
            return Event::first('404');

        }
    }

    public function action_show($post_id, $slug=null)
    {
        if ($post = Post::with(array('author','category'))->where_id($post_id)->first()) {

            return View::make('Blog::blog.show')
                ->with('post',$post);


        } else {
            return Event::first('404');

        }
    }

}
