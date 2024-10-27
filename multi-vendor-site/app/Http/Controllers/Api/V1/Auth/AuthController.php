<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(LoginRequest $credential):JsonResponse
    {
        $user = User::where('email', $credential->email)->first();

        if(!$user || !Hash::check($credential->password, $user->password)){

            return response()->json([
                "message"=> "Invalid Credentail",
            ], 200);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer'
        ]);

    }
}
