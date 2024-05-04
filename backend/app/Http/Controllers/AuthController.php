<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Responses\ValidationErrorResponse;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return new ValidationErrorResponse($validator);
            }
            
            /**@var \App\Models\User $user */
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('app');

                return response([
                    'message' => 'success',
                    'token' => $token->plainTextToken,
                    'user' => $user
                ]);
            }else {
                return response()->json([
                    'error' => 'Invalid credentials'
                ], 401);
            }

        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function user()
    {
        return Auth::user();
    }

    public function register(Request $request)
    {

        try {
            $is_admin = ($request->input('is_admin')) ? 1 : 0;

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg',
                'password_confirm' => 'required|same:password',
                'is_admin' => 'nullable'
            ]);
            
            if ($validator->fails()) {
                return new ValidationErrorResponse($validator);
            }

           $image = '/storage/' . $request->file('image')->store('/user');

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'image' => $image,
                'is_admin' => $is_admin
            ]);

            return $user;
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }
}
