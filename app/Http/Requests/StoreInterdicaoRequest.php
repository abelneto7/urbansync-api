<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\TipoInterdicao;
use App\DTOs\StoreInterdicaoDTO;
use Illuminate\Support\Carbon;

class StoreInterdicaoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $mergeData = [];

        if ($this->filled('data_inicio')) {
            $mergeData['data_inicio'] = Carbon::parse($this->input('data_inicio'));
        }

        if ($this->filled('data_fim')) {
            $mergeData['data_fim'] = Carbon::parse($this->input('data_fim'));
        }

        $this->merge($mergeData);
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
            'data_fim' => ['nullable', 'date', 'after_or_equal:data_inicio'],
        ];
    }

    public function toDto(): StoreInterdicaoDTO
    {
        $dto = new StoreInterdicaoDTO(
            auth()->id(),
            $this->input('titulo'),
            $this->float('latitude'),
            $this->float('longitude'),
            $this->integer('tipo'),
            $this->input('data_inicio'),
        );

        $dto->setDescricao($this->input('descricao'));
        $dto->setDataFim($this->input('data_fim'));

        return $dto;
    }
}
