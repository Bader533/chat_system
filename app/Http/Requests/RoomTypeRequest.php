<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomTypeRequest extends FormRequest
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
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'status' => 'required|numeric|in:0,1',
        ];

        if ($this->isMethod('put')) {
            $rules['name_en'] = 'nullable|string|max:100';
            $rules['name_ar'] = 'nullable|string|max:100';
            $rules['status'] = 'nullable|numeric|in:0,1';
        }

        // if the avatar not null
        if ($this->hasFile('avatar')) {
            $rules['avatar'] = 'mimes:jpg,png,jpeg';
        }

        return $rules;
    }
}
