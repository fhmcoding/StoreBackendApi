<?php

namespace App\Http\Controllers\V1\Backoffice\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\RoleRequest;
use App\Http\Resources\Backoffice\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    public function __invoke(RoleRequest $request, Role $role): JsonResponse
    {
        return $this->success(
            RoleResource::make(
                tap(
                    $role,
                    fn (Role $role) =>
                    $role->update([
                        'name' => $request->input('name'),
                    ]) && $role->permissions()->sync($request->input('permissions_id'))
                )
            )
        );
    }
}
