<?php

namespace App\Http\Controllers;


use App\User;
use App\Mail\SendGrid;
use App\Settings;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Str;


class AdminAuthController extends Controller
{
    use RedirectsUsers, ThrottlesLogins;


    public function __construct()
    {
        // middleware guest : RedirectIfAuthenticated
        // this middleware takes action for all of this class methods except logout
        // the middleware checks the user's guard
        // admin guard redirects to '/gwc/home'
        // user guard redirects to '/'
        $this->middleware('guest')->except('logout');
    }


    // username field
    public function username()
    {
        return 'username';
    }


    // if the user is not logged in, then will be redirected to login page
    public function index()
    {
       // $settings = Settings::where("keyname", "setting")->first();
        return view('home');
    }


    //process login
    public function login(Request $request)
    {
        $this->validate($request, [
                'username' => 'required|min:4',
                'password' => 'required|min:6'
            ],
            [
                'username.required' => 'Please enter login username',
                'password.required' => 'Please enter login password'
            ]
        );

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $remember = $request->remember ? true : false;

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'is_active' => 1
        ];

        if (Auth::guard('user')->attempt($credentials, $remember))
        {
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);


            return redirect()->intended('home/');
        }

        $this->incrementLoginAttempts($request);

        return back()->withInput()->withErrors(['invalidLogin'=>'Invalid login credentials']);
    }


    // Log the user out of the application.
    public function logout(Request $request)
    {

        //end save logs

        Auth::guard('user')->logout();

        $request->session()->invalidate();

        //$request->session()->flush();
        //$request->session()->regenerate();

        return redirect('/user/')->with("info","You have successfully logged out from user Panel");
    }


    //view forgot password screen
    public function forgot()
    {

        return view('gwc.auth.forgot');
    }


    //send reset link to email when user forgot the password
    public function sendResetLinkEmail(Request $request)
    {
        //field validation
        $this->validate($request,
            [
                'email' => 'required|email'
            ],
            [
                'email.required' => 'Please enter your email',
            ]
        );



        $user = user::where("email", $request->email)->first();

        if (empty($user->id)) {
            return redirect('/user/forgot')
                ->withErrors(['email' => trans('userMessage.email_not_register')])
                ->withInput();
        }
        else {
            $token = (string)Str::uuid();
            $user->password_token = $token;
            $user->save();

            $appendMessage = "<b><a href='" . url('gwc/forgot/' . $token) . "'>" . trans('userMessage.passwordresetlink') . "</b>";
            $data = [
                'dear' => trans('userMessage.dear') . ' ' . $user->name,
                'footer' => trans('userMessage.email_footer'),
                'message' => trans('userMessage.you_have_reqtest_fp') . "<br><br>" . $appendMessage,
                'subject' => 'user Forgot Password Reset Link',


            ];
            Mail::to($request->email)->send(new SendGrid($data));



            return redirect('/user/forgot')
                ->with('info', trans('userMessage.password_reset_link_sent'));
        }
    }


    //view forgot password screen
    public function showResetForm()
    {
        return view('gwc.auth.forgot');
    }


    // reset password
    public function resetPassword(Request $request, $token)
    {
        //field validation
        $this->validate($request,
            [
                'email' => 'required|email',
                'new_password' => 'required|min:3|max:150|string',
                'confirm_password' => 'required|min:3|max:150|string|same:new_password',
            ],
            [
                'email.required' => trans('userMessage.email_required'),
                'new_password.required' => trans('userMessage.new_password_required'),
                'confirm_password.required' => trans('userMessage.confirm_password_required'),
                'confirm_password.same' => trans('userMessage.confirm_password_mismatched'),
            ]
        );



        $user = user::where("email", $request->email)->where("password_token", $token)->first();

        if (empty($user->id)) {
            return redirect('/gwc/forgot/' . $token)
                ->withErrors(['email' => trans('userMessage.email_not_register_or_token')])
                ->withInput();
        }
        else {
            $token = (string)Str::uuid();
            $user->password_token = $token;
            $user->password = bcrypt($request->new_password);
            $user->save();

            $appendMessage = "";
            $appendMessage .= "<b>" . trans('userMessage.username') . " : </b>" . $user->username;
            $appendMessage .= "<br><b>" . trans('userMessage.password') . " : </b>" . $request->new_password;
            $data = [
                'dear' => trans('userMessage.dear') . ' ' . $user->name,
                'footer' => trans('userMessage.email_footer'),
                'message' => trans('userMessage.password_reset_done_success') . "<br><br>" . $appendMessage,
                'subject' => 'user Password Successfully Reset',


            ];
            Mail::to($request->email)->send(new SendGrid($data));

            //save logs
            $key_name = "forgot";
            $key_id = $user->id;
            $message = $user->name . " has reset his old password";
            $created_by = $user->id;
            Common::saveLogs($key_name, $key_id, $message, $created_by);
            //end save logs

            return redirect('/user/home')
                ->with('info', trans('adminMessage.password_reset_done'));
        }
    }

}
