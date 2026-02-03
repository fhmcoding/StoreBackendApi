<?php

namespace App\Http\Controllers\V1\Backoffice\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user):JsonResponse
    {
         return $this->success(
            UserResource::make(tap($user)->delete())
        );
    }
}
