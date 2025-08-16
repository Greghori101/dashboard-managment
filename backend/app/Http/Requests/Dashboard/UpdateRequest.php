<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'widgets' => ['required', 'array', 'min:1'],
            'widgets.*.type' => ['required', 'string', 'in:text,link'],
            'widgets.*.data' => ['required', 'array'],
            'widgets.*.sort' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
