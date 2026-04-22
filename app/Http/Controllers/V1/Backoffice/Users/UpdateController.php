<?php

namespace App\Http\Controllers\V1\Backoffice\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\UserRequest;
use App\Http\Resources\Backoffice\UserResource;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class UpdateController extends Controller
{
    public function __invoke(UserRequest $request, User $user): JsonResponse
    {
        return $this->success(
            UserResource::make(
                (tap($user)
                    ->update([
                        'first_name' => $request->input('first_name'),
                        'last_name' => $request->input('last_name'),
                        'phone_number' => $request->input('phone_number'),
                        'password' => bcrypt($request->input('password')),
                        'tpe' => $request->tpe,
                        'cache' => $request->cache,
                        'credit' => $request->credit,
                        'virement' => $request->virement,
                        'cheque' => $request->cheque,
                        'type' => $request->type
                    ]))
                    ->syncRoles($request->input('role_id'))
                    ->refresh()
            )
        );
    }
}
