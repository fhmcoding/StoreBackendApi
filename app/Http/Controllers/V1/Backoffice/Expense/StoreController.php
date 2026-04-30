<?php

namespace App\Http\Controllers\V1\Backoffice\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Http\Resources\Backoffice\ExpenseResource;
use Illuminate\Http\JsonResponse;
use Auth;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->success(
            ExpenseResource::make(
                Expense::query()->create([
                    'user_id' => Auth::guard('user')->id,
                    'refernece' => $request->refernece,
                    'amount' => $request->amount
                ])
            )
        );
    }
}
