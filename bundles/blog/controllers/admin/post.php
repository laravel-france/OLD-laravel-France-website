<?php

class Blog_Admin_Post_Controller extends \Base_Controller
{
    public static $rules = array(
        'title'  => 'required|max:200',
        'content' => 'required',
        'author_id' => 'exists:users,id',
        'publicated_at_date' => 'date',
        'publicated_at_time' => 'time'
    );


    public function action_list()
    {
        $posts = \Blog\Models\Post::order_by('created_at','desc')->get();
        return View::make('blog::admin.post.list')->with('posts', $posts);
    }

    public function action_new()
    {
        if (Str::lower(Request::method()) == "post")
        {

            $validator = Validator::make(Input::all(), self::$rules);

            if ($validator->passes()) 
            {
                $post = new \Blog\Models\Post();

                $post->title = Input::get('title');

                if(Input::get('slug'))
                    $post->slug = Str::slug(Input::get('slug'));
                else
                    $post->slug = Str::slug(Input::get('title'));
                
                $post->intro = Input::get('intro');
                $post->content = Input::get('content');
                $post->author_id = Input::get('author_id');
                $post->category_id = Input::get('category_id');
                $post->publicated_at = Input::get('publicated_at_date').' '.Input::get('publicated_at_time');

                $post->save();

                return Redirect::to_action('blog::admin.post@list');

            }
            else 
            {
                return Redirect::back()->with_errors($validator)->with_input();
            }


        }
        else
        {

            $originalCategories = \Blog\Models\Category::all();
            foreach ($originalCategories as $cat) {
                $categories[$cat->id] = $cat->name;
            }

            return View::make('blog::admin.post.new')
                ->with('editMode', false)
                ->with('categories', $categories);
        }
    }

    public function action_edit($id)
    {
        $post = \Blog\Models\Post::find($id);

        if ($post === null)
            return Event::first('404');

        if (Str::lower(Request::method()) == "post")
        {
            $validator = Validator::make(Input::all(), self::$rules);

            if ($validator->passes()) 
            {
                $post->title = Input::get('title');

                if(Input::get('slug'))
                    $post->slug = Str::slug(Input::get('slug'));
                else
                    $post->slug = Str::slug(Input::get('title'));
                
                $post->intro = Input::get('intro');
                $post->content = Input::get('content');
                $post->author_id = Input::get('author_id');
                $post->category_id = Input::get('category_id');
                $post->publicated_at = Input::get('publicated_at_date').' '.Input::get('publicated_at_time');

                $post->save();

                return Redirect::to_action('blog::admin.post@list');

            }
            else 
            {
                return Redirect::back()->with_errors($validator)->with_input();
            }


        }
        else
        {
            $originalCategories = \Blog\Models\Category::all();
            foreach ($originalCategories as $cat) {
                $categories[$cat->id] = $cat->name;
            }

            return View::make('blog::admin.post.new')
                ->with_post($post)
                ->with('editMode', true)
                ->with('categories', $categories);
        }
    }


    public function action_remove($id)
    {
        $post = \Blog\Models\Post::find($id);
        if($post) $post->delete();

        return Redirect::to_action('blog::admin.post@list');
    }

}
