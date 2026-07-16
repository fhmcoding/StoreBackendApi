<?php

namespace App\Http\Controllers\V1\Backoffice\Statistic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CreditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $clients = User::with('payments','orders')->where('type','client')->get();

        $creditClients = $clients ->filter(function ($user) {
            return $user->total_credit > 0;
        });;


        return response()->json([
            'success' => true,
            'clients' => count($creditClients),
        ]);
    }
}
