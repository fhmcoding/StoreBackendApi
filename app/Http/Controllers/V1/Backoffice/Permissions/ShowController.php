<?php

namespace App\Http\Controllers\V1\Backoffice\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\PermissionResource;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        return $this->success(
            PermissionResource::make(
                QueryBuilder::for(Permission::class)->findOrFail($id)
            )
        );
    }
}
