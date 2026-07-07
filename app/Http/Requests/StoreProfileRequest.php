<?php

namespace App\Http\Requests;

use App\DTOs\StoreProfileDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:profiles,name'],
            'description' => ['nullable', 'string', 'max:500'],
            'permission_ids' => ['nullable', 'array'],
            'permission_ids.*' => ['integer', 'exists:permissions,id'],
        ];
    }

    public function toDto(): StoreProfileDTO
    {
        $dto = new StoreProfileDTO(
            $this->input('name'),
            $this->input('description')
        );

        if ($this->has('permission_ids')) {
            $dto->setPermissionIds($this->input('permission_ids', []));
        }

        return $dto;
    }
}
