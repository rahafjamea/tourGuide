<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\AuthServiceProvioder;
use Auth;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Error;

class userController extends Controller
{
    public function constructer()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'nationality' => 'required',
            'email' => 'required|string||max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(
            array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            )
        );
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL()*60,
            'user' => auth()->user()
        ]);
    }

    public function profile(){
        return response()->json(auth()->user());
    }

    public function logout(){
        auth()->logout();
        return response()->json([
            'message' => 'User successfully logged out',
        ]);
    }

    public function updateName(Request $request)
    {
        
       $user = auth()->user();
       $user->name = $request->name;
       $user->update();

        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        if ($request->has('name')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            else {
            $user->name = $request->name;
            $user->update();
            }
        }

        if ($request->has('nationality')) {
            $validator = Validator::make($request->all(), [
                'nationality' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $user->nationality = $request->nationality;
            $user->update();
        }

        if ($request->has('email')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:100|unique:users',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $user->email = $request->email;
            $user->update();
        }

        if ($request->has('password')) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:6',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $user->password = $request->password;
            $user->update();
        }

        if ($request->has('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);
            $user->image = $request->file('image')->store('image', 'public');
            $user->update();
        }

        

            return response()->json([
                "status" => "success",
                "message" => "user updated successfully",
                "user" => $user
            ]);
        }
    }

