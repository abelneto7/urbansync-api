<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterdicaoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'coordenadas' => [
                'latitude' => (float) $this->latitude,
                'longitude' => (float) $this->longitude,
            ],
            'tipo' => $this->tipo?->value,
            'status' => (bool) $this->status,
            'criado_em' => $this->created_at?->format('Y-m-d H:i:s'),
            'atualizado_em' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
