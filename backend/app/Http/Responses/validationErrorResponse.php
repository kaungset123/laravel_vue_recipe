<?php
namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

use Illuminate\Contracts\Validation\Validator;
class ValidationErrorResponse extends JsonResponse
{
    public function __construct(Validator $validator)
    {
        $flattenedErrors = collect($validator->errors())->flatMap(function ($errorMessages, $field) {
            return [$field => $errorMessages[0]];
        });

        parent::__construct([
            'error' => $flattenedErrors,
            'status' => 400
        ], 400);
    }
}