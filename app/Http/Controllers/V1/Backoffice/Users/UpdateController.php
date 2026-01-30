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
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'password' => bcrypt($request->input('password')),
                        'tpe' => $request->tpe,
                        'cache' => $request->cache,
                        'credit' => $request->credit,
                        'virement' => $request->virement,
                        'cheque' => $request->cheque
                    ]))
                    ->syncRoles($request->input('role_id'))
                    ->refresh()
            )
        );
    }
}
