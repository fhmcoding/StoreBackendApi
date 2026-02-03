<?php

namespace App\Http\Controllers\V1\Backoffice\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backoffice\UserRequest;
use App\Http\Resources\Backoffice\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request):JsonResponse
    {
       return $this->success(
            UserResource::make(
                User::query()->create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'phone_number' => $request->input('phone_number'),
                    'password' => 'password',
                    'type' => 'client',
                    // 'tpe' => $request->tpe,
                    // 'cache' => $request->cache,
                    // 'credit' => $request->credit,
                    // 'virement' => $request->virement,
                    // 'cheque' => $request->cheque
                ])
            )
        );
    }
}
