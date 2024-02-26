<?php

namespace App\Traits;

trait JsonResponse
{
    /**
     * Return a standardized JSON success response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, string $message = "Success", int $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Return a standardized JSON error response.
     *
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse(string $message = "Error", int $status = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $status);
    }

    // You can add more methods here for different types of responses
}