<?php

namespace App\Http\Controllers\V1\Backoffice\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backoffice\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{
    public function __invoke(User $user): JsonResponse
    {
        return $this->success(
            UserResource::make(tap($user)->delete())
        );
    }
}
