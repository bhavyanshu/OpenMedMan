<?php

namespace OpenMedMan\Http\Controllers\Auth;

use OpenMedMan\User;
use Validator;
use Hash;
use DB;
use OpenMedMan\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Contracts\Auth\Guard;
use OpenMedMan\Http\Requests\Auth\LoginRequest;
use OpenMedMan\Http\Requests\Auth\RegisterRequest;

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

    /**
     * User model instance
     * @var User
     */
    protected $user; 
    
    /**
     * For Guard
     *
     * @var Authenticator
     */
    protected $auth;

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth, User $user)
    {
        $this->user = $user; 
        $this->auth = $auth;
        $this->middleware('guest', ['except' => ['getLogout','postAuthReset']]);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /* Login get post methods */
    protected function getLogin() {
        return View('users.login');
    }

    protected function postLogin(LoginRequest $request) {
        $checked = $request->input('remember');
        //dd($this->auth->viaRemember());
        if ($this->auth->viaRemember()) { //Always false? Needs fix but "Remember Me" works!
                return redirect()->route('dashboard');
        }
        else { //Then set remember as user opts!
            if (isset($checked)) {
                if($this->auth->attempt($request->only('email', 'password'),true)) 
                {
                    return redirect()->route('dashboard');
                }
            }
            else {
                if($this->auth->attempt($request->only('email', 'password'),false)) {
                    return redirect()->route('dashboard');
                }
            }
        }
        return redirect('users/login')->withErrors([
            'email' => 'The email or the password is invalid. Please try again.',
        ]);
    }

    /* Register get post methods */
    protected function getRegister() {
        return View('users.register');
    }

    protected function postRegister(RegisterRequest $request) {
        //$this->auth->login($this->user);
        $confirmation_code = hash_hmac('sha256', str_random(40), str_random(10));
        $this->user->confirmation_code = $confirmation_code;
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->password = bcrypt($request->password);
        $this->user->save();

        $confirmcode = array('confirmcode' => $confirmation_code);
        \Mail::send('emails.confirmation', $confirmcode, function($message) {
            $message->to($this->user->email, $this->user->name)
                ->subject('Verify your email address');
        });
        //return redirect()->route('dashboard');
        return redirect('users/login')->with('message','Verification email has been sent to you. Please check your email account.');
    }

    public function confirm($confirmation_code)
    {
        if(!$confirmation_code)
        {
            //throw new InvalidConfirmationCodeException;
            return redirect()->route('dashboard');
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (!$user)
        {
            //throw new InvalidConfirmationCodeException;
            $message = "Invalid confirmation code. Copy/Paste the url sent in your mail carefully. It's better to just click the link in mail and open in browser.";
        }
        else {
            $user->confirmed = 1;
            $user->blocked = 0;
            $user->save();
            $message = 'You have successfully verified your account.';
        }

        return redirect('users/login')->with('message',$message);
    }

    public function postAuthReset(Request $request) {
        $rules = array(
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes())
        {
            $newpassword=$request->input('password');
            $passw= Hash::make($newpassword);
            $user = $request->user();
            $userid = $user->id;
            DB::table('users')
            ->where('id', $userid)
            ->update(array('password'=>$passw,'confirmed'=>1));
            return redirect()->route('dashboard')->with('message', 'Your password has been updated!.');
        }
        return redirect()->route('password_change')
        ->withInput()
        ->withErrors($validator);
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        $this->auth->logout();
        return redirect('users/login');
    }
}
