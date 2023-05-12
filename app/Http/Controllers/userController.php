<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

class userController extends Controller
{
    function login()
    {
        return view('login');
    }

    function loginPost(Request $request)
    {
        $request -> validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if ($token = Auth::attempt($credentials)) {
            //login successful
            $userr= Auth::user();
            return response()->json([
                "message" => "login successful!",
                "success" => (string)1,
                "id" => (string)$request->id,
                "user" => $request->user(),
                "userr" => $userr,
                "token" => $token
        ]); }

            //login unsuccessful
            return response()->json([
                "message" => "Incorrect login, try again!",
                "success" => (string)0,
            ]);
      }

    function registration()
    {
        return view('registration');
    }

    function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nationality' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['nationality'] = $request->nationality;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        //registeration not successful
        if (!$user) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //registeration successful
        else{
        // return response()->json([
        //     "status" => "success",
        //     "message" => "registration successful!",
        //     "id" => (string)$user->id,
        //     "user" => $user

        // ]);
        return $this->loginPost($request);
        }
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return response()->json([
            "status" => "success",
            "message" => "user logged out"
        ]);
    }
    public function logoutt(Request $request)
    {
        if(!User::checkToken($request)){
            return response()->json([
             'message' => 'Token is required',
             'success' => false,
            ],422);
        }
        
        try {
            Auth::invalidate(Auth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getProfile(Request $request){
        try{
            $user_id = $request->user()->id;
            $data = User::findByID($user_id);
            return response()->json([
                "status" => "success",
                "message" => "User Profile",
                "data" => $data
            ]);
           } catch(\Exception $e){
                return response()->json([
                    "status" => "fail",
                    "message" => $e->getMessage(),
                    "data" => []],500);
            }
        }

        public function updateProfile(Request $request){
            $request->validate([
                'name' => 'required',
                'nationality' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);


        }
    }







