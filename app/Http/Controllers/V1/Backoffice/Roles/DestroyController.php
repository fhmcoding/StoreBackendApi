<?php

namespace App\Http\Controllers\V1\Backoffice\Roles;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{
    public function __invoke(Role $role): JsonResponse
    {
        return $this->success(
            RoleResource::make(tap($role)->delete())
        );
    }
}
