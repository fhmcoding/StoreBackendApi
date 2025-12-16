<?php

namespace App\Http\Controllers\V1\Auth\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\UserResource;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Auth;

class UpdateController extends Controller
{

    public function __invoke(Request $request):JsonResponse
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number
        ];

        if(isset($request->password) && $request->password !== null){
            $data['password'] = bcrypt($request->input('password'));
        }

        return $this->success(
            UserResource::make(
                (tap(Auth::user())
                    ->update($data))
                    ->refresh()
            )
        );
    }
}
