<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Request;
use Session;
use App\Http\Middleware\Admin;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating frontEnd for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//    use AuthenticatesUsers;

    /**
     * Where to redirect frontEnd after login.
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
//        $this->middleware('guest')->except('logout');
//        $this->middleware('admin');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
//        if ($request->customer == 'customer') {
//            if (\Auth::attempt(['email'=> $request->input('email'), 'password'=> $request->input('password')])) {
//            if (\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
//                $user = User::where('email', $request->email)->first();
//                return redirect('/');
//            } else {
//                session::flush();
//                return redirect()->back()->withErrors(['Incorrect login credentials']);
//            }
//        } else {
            if (\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = User::where('email', $request->email)->first();
                return redirect('home');
            } else {
                session::flush();
                return redirect()->back()->withErrors(['Incorrect login credentials']);
            }
//        }
    }

    public function logout(Request $request){
        \Auth::logout();
        session::flush();
        return redirect('/')->with('success','Successfully Logged Out!!');
    }
}
