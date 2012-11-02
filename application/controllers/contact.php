<?php

class Contact_Controller extends Base_Controller {

	public $restful = true;    

	public function get_index()
    {
        return View::make('contact.index');
    }    

	public function post_index()
    {
        $validation = Form_Contact::Validate(Input::all());

        if ( $validation === true ) {

            $email = Config::get('email.contact');
            // may fix that, one day...
            mail($email,'Contact depuis Laravel.fr', print_r(Input::all(), true));

            return Redirect::to_action('contact@sent');
        } else {
            return Redirect::to_action('contact')->with_errors($validation->errors);
        }
    }

    public function get_sent()
    {
        return View::make('contact.sent');
    }

}