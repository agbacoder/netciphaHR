<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateemployeesRequest extends FormRequest
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

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['bail', 'required', 'email', Rule::unique('employees')->ignore($this->employees->user_id, 'user_id')],
            'roles' => 'required|array',
                'roles.*' => 'exists:roles,name'
        ];
    }
    public function messages()
    {
        return
        [
            'first_name.required' => 'The first_name field is required',
            'last_name.required' => 'The last_name field is required',
            'email.required' => 'The email field is required',
            'email.email' => 'The email address must be valid',
            'email.unique' => 'The email address is in use',

        ];


    }
}
