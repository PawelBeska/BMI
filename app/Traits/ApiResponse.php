<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

trait ApiResponse
{
    /**
     * Building success response
     * @param $data
     * @param int $code
     * @return JsonResponse
     */

    public function successResponse($data, int $code = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'code' => $code
        ]);
    }

    /**
     * @param $message
     * @param $code
     * @return JsonResponse
     */

    public function errorResponse($message, $code): JsonResponse
    {
        return response()->json([
            'error' => $message,
        ], $code);
    }

    /**
     * @param Throwable $e
     */
    public function reportError(Throwable $e)
    {
        Log::error(
            $e->getMessage()
            . PHP_EOL . 'IN LINE: ' . $e->getLine()
            . PHP_EOL . 'IN FILE: ' . $e->getFile()
        );
    }
}
