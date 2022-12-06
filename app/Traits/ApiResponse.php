<?php
namespace App\Traits;
Trait  ApiResponse{
    public function apiResponse($data=[],$message='',$status=true,$code=200){
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ],$code);
    }

    public function apiResponseError($data=[],$message='Error',$status=false,$code=422){
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ],$code);
    }
}
