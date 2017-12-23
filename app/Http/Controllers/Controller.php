<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $data
     * @param int $status_code
     * @return Illuminate\Http\Response;
     */
    protected function sendOkResponse(array $data, int $status_code = 200)
    {
        $response = [
            'status' => 'success',
            'data' => $data
        ];

        return response()->json($response, $status_code);
    }

    /**
     * @param string $message
     * @param int $status_code
     * @return Illuminate\Http\Response;
     */
    protected function sendErrorResponse(string $message, int $status_code = 500)
    {
        $response = [
            'status' => 'error',
            'message' => $message
        ];
        
        return response()->json($response, $status_code);
    }
}
