<?php

class Blog_Admin_Post_Controller extends \Base_Controller
{
    public function action_list()
    {
        $posts = \Blog\Models\Post::order_by('created_at','desc')->get();
        return View::make('blog::admin.post.list')->with('posts', $posts);
    }

    public function action_new()
    {
        if (Str::lower(Request::method()) == "post")
        {

            $rules = array(
                'title'  => 'required|max:200',
                'content' => 'required',
                'author_id' => 'exists:users,id',
                'publicated_at_date' => 'date',
                'publicated_at_time' => 'time'
            );

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->passes()) 
            {
                $post = new \Blog\Models\Post();

                $post->title = Input::get('title');

                if(Input::get('slug'))
                    $post->slug = Str::slug(Input::get('slug'));
                else
                    $post->slug = Str::slug(Input::get('title'));
                
                $post->content = Input::get('content');
                $post->author_id = Input::get('author_id');
                $post->publicated_at = Input::get('publicated_at_date').' '.Input::get('publicated_at_time');

                $post->save();

                return Redirect::to_action('blog::admin.post@list');

            }
            else 
            {
                var_dump($validator->errors);
                exit();
                return Redirect::back()->with_errors($validator)->with_input();
            }


        }
        else
        {
            return View::make('blog::admin.post.new');
        }
    }

    public function action_remove($id)
    {
        $post = \Blog\Models\Post::find($id);
        if($post) $post->delete();

        return Redirect::to_action('blog::admin.post@list');
    }

}
