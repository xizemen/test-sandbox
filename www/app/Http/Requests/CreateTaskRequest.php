<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'task' => 'required|capitalize|max:255',
            'is_done' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'task.required' => 'A task must have a title!',
            'is_done.required' => 'A task can be done or undone!',
        ];
    }
}
