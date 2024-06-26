<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Backoffice\PermissionResource;
use Auth;

class PermissionsController extends Controller
{

    public function __invoke():JsonResponse
    {
        return $this->success(
            PermissionResource::collection(Auth::user()->getAllPermissions()),
            Response::HTTP_OK
        );

    }

}
