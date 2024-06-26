<?php

namespace App\Http\Controllers\V1\Backoffice\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\PermissionResource;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{
    public function __invoke(Permission $permission): JsonResponse
    {
        return $this->success(
            PermissionResource::make(tap($permission)->delete())
        );
    }
}
