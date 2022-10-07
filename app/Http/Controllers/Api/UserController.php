<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Laravel\Fortify\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', new Password],
            ]);
            User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')),
            ]);
            $user = User::where('email', $request->input('email'))->first();
            $access_token = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                    'access_token' => $access_token,
                    'token_type' => 'Bearer',     
                    'user' => $user,
                ],
                'User has been registered successfully',
            );
        } catch(\Exception $e) {
            return ResponseFormatter::error([
                    'message' => 'Something went wrong!',
                    'error' => $e,
                ],
                'Authentication Failed', 
                500,
            );
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email', 'string', 'max:255'],
                'password' => ['required'],
            ]);
            $credential = request(['email','password']);
            if(!Auth::attempt($credential)) {
                return ResponseFormatter::error([
                        'message' => 'Unauthorized',
                    ],
                    'Authentication Failed', 500,
                );
            }

            $user = User::where('email', $request->input('email'))->first();
            if(!Hash::check($request->input('password'), $user->password, [])) {
                throw new \Exception('Invalid Credential');
            }

            $access_token = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                    'access_token' => $access_token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                ], 
                'Authenticated',
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error([
                    'message' => 'Something went wrong!',
                    'error' => $e
                ],
                'Authentication Failed', 500,
            );
        }
    }

    public function fetch(Request $request)
    {
        return ResponseFormatter::success(
            $request->user(), 'Success',
        );
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        $data = $request->all();
        $user = Auth::user();
        $user->update($data);
        return ResponseFormatter::success(
            $user, 'Success',
        );
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success(
            $token, 'Token revoked successfully',
        );
    }
}