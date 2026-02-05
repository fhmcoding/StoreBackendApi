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
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone_number' => $request->input('phone_number'),
                    'password' => bcrypt($request->input('password')),
                    'type' => $request->type,
                    'tpe' => $request->tpe ?? true,
                    'cache' => $request->cache ?? true,
                    'credit' => $request->credit ?? false,
                    'virement' => $request->virement ?? false ,
                    'cheque' => $request->cheque ?? false
                ])->assignRole($request->input('role_id'))
            )
        );
    }
}
