<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'    => ['required', 'string', 'max:255'],
            'widgets' => ['nullable', 'array'],
            'widgets.*.type' => ['required_with:widgets', 'string', 'in:text,link'],
            'widgets.*.data' => ['required_with:widgets', 'array'],
            'widgets.*.sort' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
