<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'nama harus diisi.',
            'username.required' => 'username harus diisi.',
            'email.required' => 'email harus diisi.',
            'email.email' => 'inputan harus berupa email.',
            'password.required' => 'password harus diisi.',
            'role.required' => 'jabatan harus dipilih.'
        ];
    }

}