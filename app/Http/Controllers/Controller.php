<?php

namespace App\Http\Controllers;

use App\Constant\ErrorHttp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param string $message
     * @param array|object|null $data
     * @param integer $code
     * @return JsonResponse
     */
    public function response(string $message, array|object|null $data = null, int $code = 200): JsonResponse
    {
        $response = [
            'error' => $code === 200 ? false : true,
            'message' => $message
        ];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    public function error(string $message, string $code = ErrorHttp::SERVER_ERROR)
    {
        Log::error("error: " . $message);

        return response()->json([
            'error' => true,
            'message' => $message
        ], $code);
    }
}
