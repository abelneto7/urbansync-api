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
        ];
    }

    public function toDto(): StoreProfileDTO
    {
        return new StoreProfileDTO(
            $this->input('name'),
            $this->input('description')
        );
    }
}
