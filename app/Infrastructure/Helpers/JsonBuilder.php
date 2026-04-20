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

    public static function CustomError($validator, string $message, int $status = 422)
    {
        $errors = collect($validator);
        $customs = collect([]);
        //return $errors;
        $keys = $errors->keys();

        foreach ($errors as $key => $value) {

            $custom = [
                'field' => $key,
                'message' => $value[0],
            ];
            $customs->push($custom);
        }
        $data = ['message' => $message, 'errors' => $customs];
        return response()->json($data, $status);
    }
}
