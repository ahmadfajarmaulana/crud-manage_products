<?php
function apiResponseSuccess($data = null, $message = 'Successful request', $statusCode = 200)
{
    return response()->json([
        'status' => true,
        'message' => $message,
        'data' => $data,
    ], $statusCode);
}

function apiResponseCreated($data = null, $message = 'Data successfully created')
{
    return apiResponseSuccess($data, $message, 201);
}

function apiResponseDeleted($message = 'Data successfully deleted')
{
    return response()->json([
        'status' => true,
        'message' => $message,
    ], 200);
}

function apiResponseError($message = 'Invalid request', $statusCode = 400)
{
    return response()->json([
        'status' => false,
        'message' => $message,
    ], $statusCode);
}

function apiResponseUnauthorized($message = 'Failed authentication or invalid token')
{
    return apiResponseError($message, 401);
}

function apiResponseNotFound($message = 'Data not found')
{
    return apiResponseError($message, 404);
}
