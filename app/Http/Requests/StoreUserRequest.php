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
            'password' => $userId
                ? ['sometimes', 'required', Password::defaults()]
                : ['required', Password::defaults()],
            'profile_ids' => ['nullable', 'array'],
            'profile_ids.*' => ['integer', 'exists:profiles,id'],
        ];
    }

    public function toDto(): StoreUserDTO
    {
        $dto = new StoreUserDTO(
            $this->input('name'),
            $this->input('email'),
            $this->input('password')
        );

        if ($this->has('profile_ids')) {
            $dto->setProfileIds($this->input('profile_ids', []));
        }

        return $dto;
    }
}
