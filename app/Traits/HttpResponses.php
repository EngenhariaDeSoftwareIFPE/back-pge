<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Http\Resources\Json\JsonResource;

trait HttpResponses
{
    public function success(string $message, string|int $status, array|Model|JsonResource $data = []){
        return response()->json([
            'message' => $message,
            'statusCode' => $status,
            'data' => $data
        ], $status);
    }

    public function error(string $message, string|int $status, array|MessageBag $errors = [], array $data = []){
        return response()->json([
            'message' => $message,
            'statusCode' => $status,
            'errors' => $errors,
            'data' => $data
        ], $status);
    }
}
