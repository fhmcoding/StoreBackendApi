<?php

namespace App\Http\Controllers\V1\Backoffice\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\RoleRequest;
use App\Http\Resources\Backoffice\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __invoke(RoleRequest $request): JsonResponse
    {
        return $this->success(
            RoleResource::make(
                tap(
                    Role::query()->create([
                        'name' => $request->input('name'),
                        'guard_name' => $request->input('guard'),
                    ]),
                    fn (Role $role) => $role->permissions()->sync($request->input('permissions_id'))
                )
            )
        );
    }
}
