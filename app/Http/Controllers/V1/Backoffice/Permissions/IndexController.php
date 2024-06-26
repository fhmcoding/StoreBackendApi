<?php

namespace App\Http\Controllers\V1\Backoffice\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\PermissionResource;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->success(
            PermissionResource::collection(
                QueryBuilder::for(Permission::class)
                    ->allowedFilters('id', 'name', 'guard_name')
                    ->allowedIncludes('roles')
                    ->get()
            )->response()->getData(true)
        );
    }
}
