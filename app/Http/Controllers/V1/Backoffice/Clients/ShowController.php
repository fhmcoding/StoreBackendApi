<?php

namespace App\Http\Controllers\V1\Backoffice\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
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
