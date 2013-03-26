<?php

class Blog_Admin_Category_Controller extends \Base_Controller
{
    public static $rules = array(
        'name'  => 'required|max:200',
    );


    public function action_list()
    {
        $categories = \Blog\Models\Category::order_by('name','asc')->get();
        return View::make('blog::admin.category.list')->with('categories', $categories);
    }

    public function action_edit()
    {
        $category = \Blog\Models\Category::find(Input::get('id'));

        $attribute = Input::get('type');
        $value = Input::get('value');

        if($attribute == 'slug') {
            $value = Str::slug($value);
        }
        $category->$attribute = trim($value);

        $category->save();

        return trim($value);
    }

    public function action_new()
    {
        $slug = '';
        if (trim(Input::get('slug')) != "") {
            $slug = Str::slug(trim(Input::get('slug')));
        } else {
            $slug = Str::slug(trim(Input::get('name')));
        }



        $catArray = array(
            'name' => trim(Input::get('name')),
            'slug' => $slug
        );

        $v = Validator::make(Input::all(), self::$rules);

        if($v->passes()) {
            $category = new \Blog\Models\Category($catArray);
            $category->save();

            return Response::make('OK', 201);
        }

        return Response::make('NOK', 400);
    }

}
