<?php

namespace App\Http\Controllers\V1\Backoffice\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backoffice\PermissionRequest;
use App\Http\Resources\Backoffice\PermissionResource;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __invoke(PermissionRequest $request): JsonResponse
    {
        return $this->success(
            PermissionResource::make(
                Permission::query()->create([
                    'name' => $request->input('name'),
                ])
            )
        );
    }
}
