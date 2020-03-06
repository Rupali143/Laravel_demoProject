<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontEnd.login');
    }

    public function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' =>['required', 'string', 'min:6'],
            'confirm_password' => ['required','string','min:6'],
        ]);
//        dd($request->all());
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->confirm_password = Hash::make($request->input('confirm_password'));
        $user->save();
        return redirect()->back()->with('success','User created successfully.');
    }


    public function profileDisplay(){
            return view('frontEnd.profile');
    }

    public function updateProfile(Request $request){
        $validate =$request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        User::whereId($request->userid)->update($validate);
        return redirect()->back()->with('success','Profile Updated successfully.');
    }


    public function showChangePasswordForm(){
        return view('frontEnd.changepassword');
    }


    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), \Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        
        $user = \Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully!");

    }

}
