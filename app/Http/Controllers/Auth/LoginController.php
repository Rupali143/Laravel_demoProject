<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Request;

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

//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request){
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);
        if (\Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            $user = User::where('email',$request->email)->first();
            return redirect('home');
        }
        else{
            return redirect()->back()->withErrors(['Incorrect login credentials']);
        }
        redirect('/home');
    }

    public function logout(Request $request){
        \Auth::logout();
//        session::flash();
        return redirect('/')->with('success','Successfully Logged Out!!');
    }
}
