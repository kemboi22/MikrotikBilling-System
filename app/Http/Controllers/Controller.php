<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function success(string $message, int $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(["success" => true, "message" => $message], 200);
    }

    public function error(string $message, int $status = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json(["success" => false, "message" => $message], $status);
    }
}
