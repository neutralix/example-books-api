<?php

namespace App\Helpers;

class JsonFormatter
{
    protected static $response = [
        'code' => null,
        'message' => null,
        'data' => null,
    ];

    public static function createJson($code = null, $message = null, $data = null) {
        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['code']);
    }
}