<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthorFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->route()?->getActionMethod() ?? '';

        return [
            'store' => self::store(),
            'update' => self::update(),
        ][$method] ?? [];
    }

    /** @return string[] */
    private static function store(): array
    {
        return [
            'name' => 'required|string|max:255',
            'dob' => 'required|date_format:Y/m/d',
        ];
    }

    /** @return string[] */
    private static function update(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'dob' => 'sometimes|date_format:Y/m/d',
        ];
    }
}
