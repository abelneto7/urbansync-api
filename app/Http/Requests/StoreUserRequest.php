<?php

namespace App\Http\Requests;

use App\DTOs\StoreUserDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('usuario')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $userId],
            'password' => $userId ? ['sometimes', 'required', Password::defaults()] : ['required', Password::defaults()],
        ];
    }

    public function toDto(): StoreUserDTO
    {
        return new StoreUserDTO(
            $this->input('name'),
            $this->input('email'),
            $this->input('password')
        );
    }
}
