<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|file|max:8000',
            'name' => 'nullable|string',
            'image' => 'nullable|integer',
            'ext' => 'nullable|string',
            'size' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'file.max' => 'Загружаемый файл должен быть не более 8мб',
            'file.required' => 'Необходимо выбрать файл!',
        ];
    }
}
