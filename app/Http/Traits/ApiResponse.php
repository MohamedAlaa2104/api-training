<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;

trait ApiResponse
{
    public function ApiResponse($data, $msg, $status){
        return [
            'data'=>$data,
            'message'=>$msg,
            'status'=>$status
        ];
    }

    public function postValidator ($request) {
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'body'=>'required',
        ]);

        if ( $validator->fails() )
            return response($this->ApiResponse( null, $validator->errors(),400 ), 400);
    }
}
