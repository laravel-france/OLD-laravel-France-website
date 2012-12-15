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
            


            $body = "Nom: ". Input::get('nom') ."\n";
            $body .= "Email: ". Input::get('email') ."\n";
            if(Input::has('sujet'))
                $body .= "Sujet: ". Input::get('sujet') ."\n";
            $body .= "Message:"."\n". Input::get('message');


            mail($email,'Contact depuis Laravel.fr', $body);

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