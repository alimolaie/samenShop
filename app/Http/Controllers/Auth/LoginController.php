<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\ThrottlesLogins;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/home";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login');

    }
   private function validator(Request $request){
        //validation rules.
          $rules = [
            'email'    => 'required|email|exists:users|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
            ];

        //custom validation error messages.
         $messages = [
         'email.exists' => 'These credentials do not match our records.',
         ];

   //validate the request.
     $request->validate($rules,$messages);
         }
    private function loginFailed(){
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
        }


    public function login(Request $request)
    {
         $this->validator($request);

        if(Auth::guard('user')->attempt($request->only('email','password'),$request->filled('remember'))){
        //Authentication passed...
        return redirect()
            ->intended(route('home'))
            ->with('status','You are Logged in as user!');
    }

         //Authentication failed...
         return $this->loginFailed();
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('status','User has been logged out!');
    }

}
