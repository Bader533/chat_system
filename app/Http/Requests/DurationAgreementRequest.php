<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DurationAgreementRequest extends FormRequest
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
            'title_en' => 'required|string|min:2|max:200',
            'title_ar' => 'required|string|min:2|max:200',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ];
    }
}
