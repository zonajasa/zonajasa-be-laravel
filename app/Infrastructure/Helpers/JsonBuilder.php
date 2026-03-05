<?php

namespace App\Infrastructure\Helpers;

use Illuminate\Http\JsonResponse;

class JsonBuilder
{
    public static function OkRes(string $message, $data, int $status = 200): JsonResponse
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data], $status);
    }

    public static function ErrorRes(string $message, int $status = 422): JsonResponse
    {
        return response()->json(['status' => $status, 'message' => $message], $status);
    }
}
