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

    public function uploadToStorage($image = "")
    {
        if ($image != "") {
            $base64_string = $image;
            $output_file = "/public/storage";
            $splited = explode(',', substr( $base64_string , 5 ) , 2);
            $mime = $splited[0];
            $mime_split_without_base64=explode(';', $mime,2);
            $mime_split=explode('/', $mime_split_without_base64[0],2);
            $file_type = $mime_split[1];
            $is_file = "/".date("YmdHis").".".$file_type;

            file_put_contents(public_path('storage') . $is_file, file_get_contents($base64_string));

            return $output_file . $is_file;
        }
        return null;
    }
}
