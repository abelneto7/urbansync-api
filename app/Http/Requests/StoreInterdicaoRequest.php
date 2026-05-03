<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\TipoInterdicao;
use App\DTOs\StoreInterdicaoDTO;

class StoreInterdicaoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'tipo' => ['required', new Enum(TipoInterdicao::class)],
            'status' => ['required', 'boolean'],
        ];
    }

    public function toDto(): StoreInterdicaoDTO
    {
        $dto = new StoreInterdicaoDTO(
            $this->input('user_id'),
            $this->input('titulo'),
            $this->input('latitude'),
            $this->input('longitude'),
            $this->input('tipo')
        );

        $dto->setDescricao($this->input('descricao'));
        $dto->setStatus($this->input('status'));

        return $dto;
    }
}
