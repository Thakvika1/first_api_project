<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $r)
    {

        // validate the data
        // $validator = Validator::make($r->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|min:8|confirmed'
        // ]);


        $email = strtolower($r->email);

        $user = User::create([
            'name' => $r->name,
            'email' => $email,
            'password' => Hash::make($r->password),
        ]);

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'message' => 'Registration Successful',
            // 'token' => $user->createToken('auth_token')->plainTextToken
        ], 201);
    }


    public function login(Request $r)
    {

        // make email lowercase
        $r['email'] = strtolower($r->email);

        // validate the data
        $validator = Validator::make($r->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // check validation failed or not ( true or false )
        if ($validator->fails()) {
            return response()->json([
                'status' => 'validated error',
                'Error' => $validator->errors()
            ], 401);
        }

        // get validated data true or false
        $validated = $validator->validated();
        // dd($validated);


        // check if the user exists
        if (Auth::attempt($validated)) {
            // dd(User::createToken('access_token')->plainTextToken);
            $token = Auth::user()->createToken('access_token')->plainTextToken;

            return response()->json([
                'message' => 'success',
                'access_token' => $token,
            ], 200);
        }

        // if wrong information
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid Credentials'
        ], 401);
    }

    public function logout(Request $r)
    {

        try {
            $r->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Logged out successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
