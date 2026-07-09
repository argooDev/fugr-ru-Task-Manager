<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TaskResource',
    properties: [
        new OA\Property(property: 'title', type: 'required|string|max:255', example: 'task title'),
        new OA\Property(property: 'description', type: 'nullable|string', example: 'task description'),
        new OA\Property(property: 'deadline', type: 'nullable|date', example: '2025-12-31T23:59:59'),
        new OA\Property(property: 'status', type: 'nullable|in:pending,completed', enum: ['pending', 'completed'], example: 'pending'),
        new OA\Property(property: 'priority', type: 'nullable|in:low,medium,high', enum: ['low', 'medium', 'high'], example: 'medium'),
        new OA\Property(property: 'category', type: 'nullable|string|max:100', example: 'task category'),
    ],
    type: 'object',
)]
class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->deadline,
            'status'=> $this->status,
            'priority'=> $this->priority,
            'category' => $this->category,
            'created_at' => $this->created_at
        ];

    }
}
