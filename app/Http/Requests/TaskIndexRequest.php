<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;


#[OA\Schema(
    schema: 'TaskIndexRequest',
    required: [],
    properties: [
        new OA\Property(property: 'search', type: 'nullable|string|max:255', example: 'search by title'),
        new OA\Property(property: 'sort', type: 'nullable|in:deadline,created_at,id,title', example: 'sorting'),
        new OA\Property(property: 'per_page', type: 'nullable|integer|min:1|max:100', example: 'paginate'),
    ],
    type: 'object',
)]
class TaskIndexRequest extends FormRequest
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
            'search' => 'nullable|string|max:255',
            'sort' => 'nullable|in:deadline,created_at,id,title',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }
}
