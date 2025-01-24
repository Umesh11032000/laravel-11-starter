<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'first_name' => [
                'required',
                'min:3',
                'max:50',
            ],
            'middle_name' => [
                'nullable',
                'min:3',
                'max:50',
            ],
            'last_name' => [
                'required',
                'min:3',
                'max:50',
            ],
            'email' => [
                'required',
                'email',
                'min:3',
                'max:50',
            ],
            'mobile_number' => [
                'required',
                'digits:10',
            ],
            'gender' => [
                'required',
                Rule::enum(Gender::class)
            ],
            'role_id' => [
                'required',
                'exists:roles,id',
            ],
            'date_of_birth' => [
                'required',
                'date_format:Y-m-d',
            ],
            'address' => [
                'required',
                'min:3',
                'max:255',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => __('validation.required', ['attribute' => __('module.user.first_name')]),
            'first_name.min' => __('validation.min.string', ['attribute' => __('module.user.first_name'), 'min' => 3]),
            'first_name.max' => __('validation.max.string', ['attribute' => __('module.user.first_name'), 'max' => 50]),

            'middle_name.min' => __('validation.min.string', ['attribute' => __('module.user.middle_name'), 'min' => 3]),
            'middle_name.max' => __('validation.max.string', ['attribute' => __('module.user.middle_name'), 'max' => 50]),

            'last_name.required' => __('validation.required', ['attribute' => __('module.user.last_name')]),
            'last_name.min' => __('validation.min.string', ['attribute' => __('module.user.last_name'), 'min' => 3]),
            'last_name.max' => __('validation.max.string', ['attribute' => __('module.user.last_name'), 'max' => 50]),

            'email.required' => __('validation.required', ['attribute' => __('module.user.email')]),
            'email.email' => __('validation.email', ['attribute' => __('module.user.email')]),
            'email.min' => __('validation.min.string', ['attribute' => __('module.user.email'), 'min' => 3]),
            'email.max' => __('validation.max.string', ['attribute' => __('module.user.email'), 'max' => 50]),

            'mobile_number.required' => __('validation.required', ['attribute' => __('module.user.mobile_number')]),
            'mobile_number.digits' => __('validation.digits', ['attribute' => __('module.user.mobile_number'), 'digits' => 10]),

            'gender.required' => __('validation.required', ['attribute' => __('module.user.gender')]),

            'role_id.required' => __('validation.required', ['attribute' => __('module.user.role')]),
            'role_id.exists' => __('validation.exists', ['attribute' => __('module.user.role')]),

            'date_of_birth.required' => __('validation.required', ['attribute' => __('module.user.date_of_birth')]),
            'date_of_birth.date_format' => __('validation.date_format', ['attribute' => __('module.user.date_of_birth'), 'format' => 'Y-m-d']),

            'address.required' => __('validation.required', ['attribute' => __('module.user.address')]),
            'address.min' => __('validation.min.string', ['attribute' => __('module.user.address'), 'min' => 3]),
            'address.max' => __('validation.max.string', ['attribute' => __('module.user.address'), 'max' => 255]),
        ];
    }
}
