<?php

namespace App\Http\Controllers\V1\Backoffice\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\UserRequest;
use App\Http\Resources\Backoffice\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __invoke(UserRequest $request): JsonResponse
    {
        return $this->success(
            UserResource::make(
                User::query()->create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                ])->assignRole($request->input('role_id'))
            )
        );
    }
}
