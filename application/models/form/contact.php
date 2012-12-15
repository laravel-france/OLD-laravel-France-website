<?php

class Form_Contact {

    public static $rules = array(
        'nom' => 'required',
        'email' => 'required|email',
        'sujet' => '',
        'message' => 'required|min:10'
    );


    public static function Validate($input)
    {
         $validation = Validator::make($input, static::$rules);

         return ($validation->fails()) ? $validation : true;
    }




}