<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($responseData = null, $statusCode = 200)
    {
        $data = is_array($responseData) ? $responseData : ($responseData ?: [
            'message' => 'Success',
        ]);

        return response()->json($data, $responseData == '' ? 204 : $statusCode);
    }

    protected function error($exception, $statusCode = null)
    {
        $isException = $exception instanceof \Exception;
        $message = $isException ? $exception->getMessage() : $exception;

        if (! $statusCode) {
            $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
        }

        return response()->json(compact('message'), $statusCode);
    }
}
