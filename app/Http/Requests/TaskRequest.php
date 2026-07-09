<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;


#[OA\Schema(
    schema: 'TaskRequest',
    required: [],
    properties: [
        new OA\Property(property: 'title', type: 'required|string|max:255', example: 'task title'),
        new OA\Property(property: 'description', type: 'nullable|string', example: 'task description'),
        new OA\Property(property: 'deadline', type: 'nullable|date', example: 'task deadline'),
        new OA\Property(property: 'status', type: 'nullable|in:pending,completed', example: 'task status'),
        new OA\Property(property: 'priority', type: 'nullable|in:low,medium,high', example: 'tast priority'),
        new OA\Property(property: 'category', type: 'nullable|string|max:100', example: 'task category'),
    ],
    type: 'object',
)]

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'status' => 'nullable|in:pending,completed',
            'priority' => 'nullable|in:low,medium,high',
            'category' => 'nullable|string|max:100',
        ];
    }
}
