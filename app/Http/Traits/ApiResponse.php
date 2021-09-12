<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;

trait ApiResponse
{
    public function ApiResponse($data, $msg){
        return [
            'data'=>$data,
            'message'=>$msg,
        ];
    }
}
