<?php

use Blog\Models\Post;

class Blog_Category_Controller extends Base_Controller
{

    public function action_index($category_slug)
    {
        $posts = Post::with(
            array('author',
                'category' => function($query) use ($category_slug) {
                    $query->where_slug($category_slug);
                }
            )
        )->order_by('created_at','desc')->paginate(10);


        if ( $posts ) {
            
            return View::make('Blog::blog.list')
                ->with('posts',$posts->results)
                ->with('pagination',$posts->links());


        } else {
            return Event::first('404');

        }
    }
}
