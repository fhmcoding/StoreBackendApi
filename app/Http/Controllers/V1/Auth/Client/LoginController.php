<?php

namespace App\Http\Controllers\V1\Auth\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Backoffice\UserResource;
use App\Models\User;


class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request):JsonResponse
    {
        if ($user = User::query()->where('phone_number', $request->input('phone_number'))->first()) {
            if (password_verify($request->input('password'), $user->password)) {
                return response()->json([
                    'message' => __('Sign In Successful'),
                    'user' => UserResource::make($user),
                    'token_type' => 'Bearer',
                    'token' => $user->createToken('Client Token', ['client'])->accessToken,
                ]);
            }
            return response()->json([
                'message' => __('phone number or Password not correct !'),
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'message' => __('phone number does not exist'),
        ], Response::HTTP_NOT_FOUND);
    }
}
