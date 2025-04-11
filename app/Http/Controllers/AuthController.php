<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        try{
            $role = Role::where('name' , $request->role)->first();
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'team_id' => null
            ]);
            $user->roles()->attach($role->id);
            $user->save();
        }catch(Exception $e){
            return "error $e";
        }
        $token = JWTAuth::fromUser($user);
        $role = $user->roles();
        // return $role ;

        // return response()->json(compact('user', 'role' , 'token'), 201);
        return response()->json(compact( 'role' , 'token'), 201);
    }
    public function hasRoles()
    {
        // return "ascasc";
       $roles =  auth()->user();
       return $roles->roles ;
    }
    public function login(Request $request)
    {
        $user  = User::where('email', request(['email']))->first();
        // return $user;
            // return request(['email']);
            $credentials = $request->only('email', 'password');
            // return $credentials ;
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'Invalid credentials'], 401);
                }
                $user = auth()->user();
                $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);
                return response()->json(compact('token'));
            } catch (JWTException $e) {
                return response()->json(['error' => 'Could not create token'], 500);
            }
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
