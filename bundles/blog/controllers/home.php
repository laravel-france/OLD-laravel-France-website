<?php

use Blog\Models\Post;

class Blog_Home_Controller extends Base_Controller
{

    public function action_index()
    {
        if ($posts = Post::with(array('author'))->order_by('created_at','desc')->paginate(10)) {
            
            return View::make('blog::blog.list')
                ->with('posts',$posts->results)
                ->with('pagination',$posts->links());
        } else {
            return Event::first('404');
        }
    }

    public function action_rss()
    {
        if ($posts = Post::with(array('author'))->order_by('created_at','desc')->take(10)->get()) {
            
            return View::make('blog::blog.list_rss')
                ->with('posts',$posts);
        } else {
            return Event::first('404');
        }
    }

    public function action_show($post_id, $slug=null)
    {
        if ($post = Post::with(array('author'))->where_id($post_id)->first()) {

            return View::make('blog::blog.show')
                ->with('post',$post);


        } else {
            return Event::first('404');

        }
    }

    public function action_resolve($post_id)
    {
        if ($post = Post::where_id($post_id)->first(array('id','slug'))) {
            return Redirect::to_action('blog::home@show', array($post->id, $post->slug));
        } else {
            return Event::first('404');
        }
    }

}
