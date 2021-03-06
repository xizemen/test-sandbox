<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:tasks|min:1',
            'task' => 'required|max:255',
            'is_done' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Invalid task ID provided.',
            'task.required' => 'A task must have a title!',
            'is_done.required' => 'A task can be done or undone!',
        ];
    }
}
