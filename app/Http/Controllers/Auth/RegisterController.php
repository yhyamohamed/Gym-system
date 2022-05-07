<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CityManager;
use App\Models\Gym;
use App\Models\GymManager;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function showRegistrationForm()
    {
        $gyms = Gym::all();
        return view('auth.register')->with('gyms', $gyms);
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
            'name' => ['required', 'string', 'max:255'],
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

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'position_id' => $data['position_id'] ,
        ]);
        $role = 'user';
        if ($data['position_id'] == 1) {
            $role = 'admin';

        } else if ($data['position_id'] == 2) {
            CityManager::create(
                [
                    'user_id' => $user->id,
                    'NID' => $data['cmanager_NID']
                ]
            );
            $role = 'city_manager';
        } else if ($data['position_id'] == 3) {
            GymManager::create(
                [
                    'user_id' => $user->id,
                    'NID' => $data['gmanager_NID'],
                    'gym_id' => $data['gym_id']
                ]
            );
            $role = 'gym_manager';
        }
        $user->assignRole($role);
        return $user;

    }
}
