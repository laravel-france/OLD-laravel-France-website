<?php

class Panel_Pseudo_Controller extends Base_Controller {


    public function action_show()
    {
        return View::make('panel::panel.pseudo');
    }

    public function action_submit()
    {
        $pseudo = Input::get('pseudo');

        $user = User::where_username($pseudo)->first('id');
        if ($user != null && $user->id != Auth::user()->id) return Response::make(json_encode(array('message' => 'Le pseudo est déjà utilisé')), 400);
        elseif ($user != null && $user->id == Auth::user()->id) return Response::make(json_encode(array('message' => 'Ce pseudo est le votre')), 200);

        $validator = Validator::make(array('pseudo' => $pseudo), array('pseudo' => 'min:3|required'));
        if ($validator->fails()) return Response::make(json_encode(array('message' => 'Pseudo invalide (min: 3 caractères)')), 400);
        Auth::user()->username = trim($pseudo);
        Auth::user()->save();
        return Response::make(json_encode(array('message' => 'Pseudo mis à jour')), 200);
    }

    public function action_check()
    {
        $pseudo = Input::get('pseudo');
        $user = User::where_username($pseudo)->first('id');

        if ($user != null && $user->id != Auth::user()->id) return 'nok';
        elseif ($user != null && $user->id == Auth::user()->id) return 'ok';

        $validator = Validator::make(array('pseudo' => $pseudo), array('pseudo' => 'min:3|required'));
        if ($validator->fails()) return 'nok';
        return 'ok';
    }


}
