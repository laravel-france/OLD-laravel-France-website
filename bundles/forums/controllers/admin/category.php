<?php

class Forums_Admin_Category_Controller extends Base_Controller
{
    public static $rules = array(
        'title'  => 'required|max:200',
        'desc'  => 'required',
    );


    public function action_list()
    {
        $categories = Forumcategory::order_by('order','asc')->get();
        return View::make('forums::admin.category.list')->with('categories', $categories);
    }

    public function action_edit()
    {
        $category = Forumcategory::find(Input::get('id'));

        $catArray = array(
            'title' => trim(Input::get('title')),
            'slug' => Str::slug(trim(Input::get('title'))),
            'desc' => trim(Input::get('desc')),
        );

        $v = Validator::make($catArray, self::$rules);

        if($v->passes()) {
            $category->fill($catArray);
            $category->save();
            return Response::make('OK', 200);
        }

        return Response::make('NOK', 400);
    }

    public function action_setorder()
    {
        $category = Forumcategory::find(Input::get('id'));
        $category->order = Input::get('order');
        $category->save();
        return Response::make('OK', 200);
    }


    public function action_new()
    {
        $catArray = array(
            'title' => trim(Input::get('title')),
            'slug' => Str::slug(trim(Input::get('title'))),
            'desc' => trim(Input::get('desc')),
            'order' => 99,
        );

        $v = Validator::make($catArray, self::$rules);

        if($v->passes()) {
            $category = new Forumcategory($catArray);
            $category->save();

            return Response::make('OK', 201);
        }

        return Response::make('NOK', 400);
    }

    public function action_remove($id)
    {
        $category = Forumcategory::find($id);
        if($category) $category->delete();

        return Redirect::back();
    }
}
