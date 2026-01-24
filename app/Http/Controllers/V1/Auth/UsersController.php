<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;


class UsersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
       return $this->success(
            UserResource::collection(
                QueryBuilder::for(User::class)
                    ->allowedFilters('name', 'email')
                    ->allowedIncludes('roles')
                    ->optionalPagination()
            )->response()->getData(true)
        );
    }
}
