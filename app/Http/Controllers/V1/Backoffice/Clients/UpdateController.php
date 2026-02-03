<?php

namespace App\Http\Controllers\V1\Backoffice\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backoffice\UserRequest;
use App\Http\Resources\Backoffice\UserResource;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        return $this->success(
            UserResource::make(
                (tap($user)
                    ->update([
                        'first_name' => $request->input('first_name'),
                        'last_name' => $request->input('last_name'),
                        'phone_number' => $request->input('phone_number'),

                    ]))

                    ->refresh()
            )
        );
    }
}
