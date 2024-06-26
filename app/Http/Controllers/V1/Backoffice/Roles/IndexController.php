<?php

namespace App\Http\Controllers\V1\Backoffice\Roles;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->success(
            RoleResource::collection(
                QueryBuilder::for(Role::class)
                    ->allowedFilters('name', 'guard_name')
                    ->allowedIncludes('permissions','permissionsCount')
                    ->get()
            )->response()->getData(true)
        );
    }
}
