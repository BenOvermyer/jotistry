<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\MessageBag;
use Input;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin()
    {
        $errors = (Input::old('errors')) ? Input::old('errors') : new MessageBag();
        $viewData = [
            'pageTitle' => 'Login',
            'errors'    => $errors,
            'redirect'  => Input::get('redirect_to'),
        ];

        return view('auth.login', $viewData);
    }

    public function postLogin()
    {
        $email = Input::get('email');
        $validator = Validator::make(Input::all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->passes()) {
            $credentials = [
                'email'    => $email,
                'password' => Input::get('password'),
            ];
            if (Auth::attempt($credentials)) {
                if ($redirect_admin = Input::get('redirect_to')) {
                    return redirect()->to($redirect_admin);
                }

                return redirect()->route('dashboard');
            }
            $data['errors'] = new MessageBag([
                'password' => 'Email and/or Password are invalid',
            ]);
        } else {
            $data['errors'] = $validator->getMessageBag();
        }
        $data['email'] = $email;

        return redirect()->route('auth.login')->withInput($data);
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
