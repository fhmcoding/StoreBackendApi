<?php

namespace App\Http\Controllers\V1\Auth\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Backoffice\UserResource;
use App\Http\Resources\Backoffice\PermissionResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request):JsonResponse
    {
        // Check if phone number already exists
        if (User::where('phone_number', $request->phone_number)->exists()) {
            return response()->json([
                'message' => __('Phone number already exists'),
            ], Response::HTTP_CONFLICT);
        }

        // Create user
        $user = User::create([
            'phone_number' => $request->phone_number,
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'password'     => Hash::make($request->password),

            'type' => 'client'
        ]);

        return response()->json([
            'message' => __('Registration successful'),
            'user' => UserResource::make($user),
            'token_type' => 'Bearer',
            'token' => $user->createToken('Client Token', ['client'])->accessToken,
        ], Response::HTTP_CREATED);


    }
}
