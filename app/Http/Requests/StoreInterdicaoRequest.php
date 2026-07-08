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
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'tipo' => ['required', new Enum(TipoInterdicao::class)],
            'data_inicio' => ['required', 'date'],
            'data_fim' => ['nullable', 'date'],
        ];
    }

    public function toDto(): StoreInterdicaoDTO
    {
        $dto = new StoreInterdicaoDTO(
            auth()->id(),
            $this->input('titulo'),
            $this->input('latitude'),
            $this->input('longitude'),
            $this->input('tipo'),
            $this->input('data_inicio'),
        );

        $dto->setDescricao($this->input('descricao'));
        $dto->setDataFim($this->input('data_fim'));

        return $dto;
    }
}
