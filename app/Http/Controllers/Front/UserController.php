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


    public function login(Request $request){
        if (\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            return redirect('/');
        } else {
            session::flush();
            return redirect()->back()->withErrors(['Incorrect login credentials']);
        }
    }

    public function profileDisplay(){
            return view('frontEnd.profile');
    }

    public function updateProfile(Request $request){
//        dd($request->all());

        $validate =$request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
//        $validate1 =$request->validate([
//            'files.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//        ]);
        User::whereId($request->userid)->update($validate);



//        $user = new User();
//        $user->name = $request->input('name');
//        $user->email = $request->input('email');
////        $user->password = Hash::make($request->input('password'));
//        User::whereId($request->userid)->update($user);;
//        $user->confirm_password = Hash::make($request->input('confirm_password'));
        return redirect()->back()->with('success','Profile Updated successfully.');
//        return view('frontEnd.myAccount');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
