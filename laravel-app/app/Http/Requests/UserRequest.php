<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . ($userId ? $userId->id : null),
            'password' => 'required|min:6'
        ];
    }

    /**
     * Manipulate validations and returns a JSON answer with the validations errors.
     * 
     * @param \Illuminate\Contracts\Validation\Validator $validator is the object validated containing the validations mistakes.
     * @throws \Illuminate\http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422));
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Field name is required.',
            'email.required' => 'Field email is required.',
            'email.email' => 'Field email must be a valid email address.',
            'email.unique' => 'This email already exists.',
            'password.required' => 'Field password is required.',
            'password.min' => 'Field password must have at least :min characters.'
        ];
    }
}
