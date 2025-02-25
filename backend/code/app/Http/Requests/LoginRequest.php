<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'email|required|exists:users,email',
            'password' => 'string|required|min:6',
        ];
    }

    public function messages(): array{
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.exists' => 'Email is invalid',
            'password.required' => 'Password is required',
            'password.string' => 'Password is invalid',
            'password.min' => 'Password is too short',
        ];
    }
}
