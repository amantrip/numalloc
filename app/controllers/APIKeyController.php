<?php

class APIKeyController extends \BaseController {

    public function showAPIKeysView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user

        if($user->type == 'system'){


            $apikeys = DB::table('api_keys')
                ->join('users', 'api_keys.UID', '=', 'users.id')
                ->select('api_keys.id', 'api_keys.api', 'users.email')
                ->get();


        }else{

            $apikeys = DB::table('api_keys')
                ->join('users', function ($join) use ($user) {

                    $join->on('api_keys.UID', '=', 'users.id')
                        ->where('api_keys.UID', '=', $user->id);
                })
                ->select('api_keys.id', 'api_keys.api', 'users.email')
                ->get();

        }

        return View::make('apikeys', ['apikeys' => $apikeys]);

    }

    public function generateAPIKey(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user

        $api = Str::random(80);

        $apikey = APIKeys::create([
            'api'   => $api,
            'UID'   => $user->id
        ]);

        return Redirect::to('/apikeys');

    }


    public function deleteAPIKey($id){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user
        $api_key = APIKeys::find($id);

        if($user->type == 'system'){

            $api_key->delete();

        }else{

            if($api_key->UID == $user->id){
                $api_key->delete();
            }else{
                Session::flash('error_message', 'Fatal Error! You don\'t have permission to delete this key.');
                return Redirect::to('/apikeys');
            }

        }
        Session::flash('success_message', 'API Key successfully deleted.');
        return Redirect::to('/apikeys');

    }


}
