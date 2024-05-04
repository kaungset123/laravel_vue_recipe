<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Responses\ValidationErrorResponse;

class ForgotController extends Controller
{
    public function forgot(Request $request){
        try{
            $email = $request->input(['email']);
    
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
    
            if ($validator->fails()) {
                return new ValidationErrorResponse($validator);
            }

            if(User::where('email', $email)->doesntExist()){
                return response([
                    'message' => 'user doesn\'t exist',
                ],400);
            }
    
            $token = Str::random(10);   
    
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token
            ]);

            Mail::to($email)->send(new PasswordResetMail($token));

            /** SEND EMAIL */
            return response([
                'message' => 'check your email!'
            ]);

        }catch(Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function reset(Request $request){
        
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'password' => 'required|min:6',
            'password_confirm' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return new ValidationErrorResponse($validator);
        }

        $token = $request->input('token');

        if(!$passwordReset = DB::table('password_reset_tokens')->where('token', $token)->first()){
            return response([
                'message' => 'invalid token'
            ], 400);
        }

        if(!$user = User::where('email', $passwordReset->email)->first()){
            return response([
                'message' => 'email doesn\'t exist'
            ], 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response([
            'message' => 'success'
        ]);
    }
}
