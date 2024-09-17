<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $rules = [
            'name' => 'required | String | max:100',
            'email' => 'required | email | unique:users,email',
            'password' => 'required | String | confirmed',
            'type' => 'required | numeric | in:0,1',
            'status' => 'required | numeric | in:0,1',
            'role' => 'required|exists:roles,id',
        ];

        if ($this->isMethod('put')) {
            $rules['name'] = 'nullable|string|max:200';
            $rules['email'] = 'nullable|email';
            $rules['password'] = 'nullable|String|confirmed';
            $rules['type'] = 'nullable|numeric|in:0,1';
            $rules['status'] = 'nullable|numeric|in:0,1';
            $rules['role'] = 'nullable|exists:roles,id';
        }

        return $rules;
    }
}
