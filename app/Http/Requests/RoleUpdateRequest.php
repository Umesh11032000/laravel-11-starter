<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
            'permissions' => [
                'required',
                'array',
            ],
            'permissions.*' => [
                'required',
                'exists:permissions,id',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 255 characters',
            'name.min' => 'Name must be at least 3 characters',
            'permissions.required' => 'Permissions are required',
            'permissions.array' => 'Permissions must be an array',
            'permissions.*.required' => 'Each permission is required',
            'permissions.*.exists' => 'Each permission must exist',
        ];
    }
}
