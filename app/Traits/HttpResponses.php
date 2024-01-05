<?php

namespace App\Traits;

trait HttpResponses {
    
    public function response( $message  = 'Success', $data = [],$status = 200){
        return response()->json([
            'success'=>true,
            'message'=>$message,
            'data'=>$data
        ],$status);
    }

    public function error($message, $status = 404, $success = false){
        return response()->json([
            'success' => $success,
            'message' => $message
        ], $status);
    }
}