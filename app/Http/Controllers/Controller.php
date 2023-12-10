<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse($status=true, $message="", $data=[], $code=200)
    {
        return response()->json([
            "status"=> $status,
            "message"=> $message,
            "data"=> $data
        ], $code);
    }
}
