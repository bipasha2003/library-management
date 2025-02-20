<?php
namespace App\Traits;

trait WithResponse{

    public function responseSuccess($message = null,$data = null)
    {
        return response([
            "status" => true,
            "data" => $data,
            "message" => $message ?? "Your request was successfull"
        ],200);
    }

    public function responseFailed($message = null,$data = null)
    {
        return response([
            "status" => false,
            "data" => $data,
            "message" => $message ?? "Your request was not completed"
        ],400);
    }

    public function responseError($message = null)
    {
        return response([
            "status" => false,
            "message" => $message ?? "Your request was not completed"
        ],500);
    }
}