<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Backoffice\UserResource;
use Illuminate\Http\JsonResponse;
use Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request):JsonResponse
    {
        $user = User::find(Auth::guard('user')->user()->id);

        if($request->input('first_name') !== null){
            $user->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone_number' => $request->input('phone_number'),
            ]);
        }

        if($request->new_password !== null){
            if($request->new_password == $request->confirm_new_password){
                if(password_verify($request->input('current_password'), $user->password)){
                    $user->update([
                        'password' => bcrypt($request->input('new_password'))
                    ]);
                }
            }
        }

        return $this->success(
            UserResource::make($user)
        );
    }
}
