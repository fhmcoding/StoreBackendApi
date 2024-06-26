<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Backoffice\UserResource;
use App\Http\Resources\Backoffice\PermissionResource;
use App\Models\User;


class LoginController extends Controller
{


    public function __invoke(LoginRequest $request):JsonResponse
    {
        if ($user = User::query()->where('email', $request->input('email'))->first()) {
            if (password_verify($request->input('password'), $user->password)) {
                return response()->json([
                    'message' => __('Sign In Successful'),
                    'user' => UserResource::make($user),
                    'token_type' => 'Bearer',
                    'token' => $user->createToken('User Token', ['user'])->accessToken,
                    'roles' => PermissionResource::collection($user->getAllPermissions()),
                ]);
            }
            return response()->json([
                'message' => __('Email number or Password not correct !'),
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'message' => __('Email number does not exist'),
        ], Response::HTTP_NOT_FOUND);
    }

}
