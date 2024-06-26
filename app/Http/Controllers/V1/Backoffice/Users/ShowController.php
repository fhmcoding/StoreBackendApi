<?php

namespace App\Http\Controllers\V1\Backoffice\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        return $this->success(
            UserResource::make(
                QueryBuilder::for(User::class)
                    ->allowedIncludes('roles')
                    ->findOrFail($id)
            )
        );
    }
}
