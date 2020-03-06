<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Eloquent\Model\Product;
use App\Eloquent\Model\Favourite;

class ApiController extends Controller
{
    //API for registration
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['status' => true, 'message' => 'Registered Successfully', 'data' =>['user'=>$user]],200,['access_token'=>$accessToken]);
    }

//API for login
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        if(auth()->attempt($loginData)){
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            return response()->json(['status' => true, 'message' => 'Valid credentials', 'data' => ['user'=>auth()->user()]],200,['access_token' => $accessToken]);

        }else{
            return response()->json(['status' => false, 'message' => 'Invalid credentials', 'data' => []]);
        }
    }

    //API for display products
    public function displayProducts(){
        $product = Product::where('status',1)->get();
        return response()->json(['status' => true, 'message' => 'Fetched Products', 'data' => $product]);
    }

    //API for display product details
    public function productDetails($id)
    {
        $productDetails = Product::with('image')->where('id', $id)->get();
        if (count($productDetails) > 0) {
            return response()->json(['status' => true, 'message' => 'Product details fetched.', 'data' => $productDetails]);
        } else {
            return response()->json(['status' => false, 'message' => 'Product not found.', 'data' => []]);
        }
    }

    //API for logout
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['status' => true,'message' => 'Successfully logged out','data'=>[]]);
    }

   //API for add product to wishList
    public function myWishList($productId,$userId){
        $favouriteData = Favourite::where('customer_id',$userId)->where('product_id',$productId)->first();
        if(isset($favouriteData->customer_id) and isset($productId))
        {
            return response()->json(['status' => false, 'message' => 'This item is already in your WishList!!.', 'data' => []]);
        }else {
            $favourite = new Favourite();
            $favourite->product_id = $productId;
            $favourite->customer_id = $userId;
            $favourite->save();
            $result =  Favourite::where('customer_id',$userId)->get();
            return response()->json(['status' => true, 'message' => 'Added to Favourite list successfully!!.', 'data' => $result]);
        }
    }
    //My profile update
    public function myProfile(Request $request){

        $data = array();
        if($request->email){
            $data['email'] = $request->email;
        }if($request->name){
            $data['name'] = $request->name;
        }
        if($data)
        \DB::table('users')->where('id', $request->userId)->update($data);
        $user =  User::whereId($request->userId)->first();
//        dd($user);
        return response()->json(['status' => true, 'message' => 'Profile Updated Successfully!!.', 'data' => $user]);
    }

    public function getUser()
    {
        $user = \Auth::user();
        dd($user);
    }

}
