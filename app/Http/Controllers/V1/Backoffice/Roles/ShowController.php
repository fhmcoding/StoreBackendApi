<?php

namespace App\Http\Controllers\V1\Backoffice\Roles;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        return $this->success(
            RoleResource::make(
                QueryBuilder::for(Role::class)
                    ->allowedIncludes('permissions')
                    ->findOrFail($id)
            )
        );
    }
}
