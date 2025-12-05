<?php

namespace App\Http\Controllers\V1\Auth\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Backoffice\UserResource;
use App\Http\Resources\Backoffice\PermissionResource;
use App\Models\User;



class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request):JsonResponse
    {

    }
}
