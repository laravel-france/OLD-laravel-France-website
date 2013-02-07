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

            $headers ='From: "'.Input::get('nom').' "<'.Input::get('email').'>'."\n"; 
            $headers .='Reply-To: '.Input::get('email') . "\n"; 
            $headers .='Content-Type: text/plain; charset="utf-8"'."\n"; 
            $headers .='Content-Transfer-Encoding: 8bit'; 


            mail($email,'Contact depuis Laravel.fr', $body, $headers);

            return Redirect::to_action('contact@sent');
        } else {
            return Redirect::to_action('contact')->with_errors($validation->errors)->with_input();
        }
    }

    public function get_sent()
    {
        return View::make('contact.sent');
    }

}