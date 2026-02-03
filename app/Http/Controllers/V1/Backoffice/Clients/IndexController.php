<?php

namespace App\Http\Controllers\V1\Backoffice\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{

    public function __invoke(Request $request)
    {
        return $this->success(
            UserResource::collection(
                QueryBuilder::for(User::class)
                    ->where('type','client')
                    ->allowedFilters('first_name', 'last_name','type')
                    ->allowedIncludes('roles')
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
