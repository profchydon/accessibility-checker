<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * Send a JSON response.
     *
     * @param $status
     * @param $message
     * @param null $data
     * @return JsonResponse
     */
    public function response($status, $message, $data = null): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public function noContent()
    {
        return response()->noContent();
    }

    /**
     * Sends a JSON error response.
     *
     * @param $status
     * @param $message
     * @param null $errors
     * @return JsonResponse
     */
    public function error($status, $message, $errors = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }

    /**
     * /*
     * Handles a validation error.
     *
     * @param $errors
     * @return JsonResponse
     */
    public function validationError($errors): JsonResponse
    {
        return $this->error(Response::HTTP_UNPROCESSABLE_ENTITY, 'Validation error', $errors);
    }

    /**
     * Handles a server error.
     *
     * @return JsonResponse
     */
    public function serverError(): JsonResponse
    {
        return $this->error(Response::HTTP_INTERNAL_SERVER_ERROR, 'Internal server error occurred');
    }
}
