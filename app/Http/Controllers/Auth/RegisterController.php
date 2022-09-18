<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nom' => ['required', 'string','min:2', 'max:150'],
            'prenom' => ['required', 'string','min:2', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //dd($data);
        $username=$this->userId($data['nom'],$data['prenom']);
        $newdata=[
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'username' => $username,
            'password' => Hash::make($data['password']),
            'profile_photo_path' => config('app.avatar.default')
        ];
        //dd($newdata);
        return User::create($newdata);
    }
    protected function userId($n,$p){
        $v=Str::slug($n).'.'.Str::slug($p);
        $uid=substr($v,0,20);
        //dd($uid);
        $cmpt=0;
        do{
            if($cmpt>0){
                $user_id=$uid.".".$cmpt;
            }else{
                $user_id=$uid ;
            }
            $cmpt++;
            $nb=User::where('username',$user_id)->count();
            //dd($nb);
        }while($nb>0);
        
        return $user_id;
    }
}
