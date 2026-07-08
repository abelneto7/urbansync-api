<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Interdicao;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterdicaoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Interdicao $interdicao */
        $interdicao = $this->resource;

        return [
            'id' => $interdicao->id,
            'titulo' => $interdicao->titulo,
            'descricao' => $interdicao->descricao,
            'coordenadas' => [
                'latitude' => (float) $interdicao->latitude,
                'longitude' => (float) $interdicao->longitude,
            ],
            'tipo' => $interdicao->tipo?->value,
            'data_inicio' => $interdicao->data_inicio,
            'data_fim' => $interdicao->data_fim,
            'criado_em' => $interdicao->created_at?->format('Y-m-d H:i:s'),
            'atualizado_em' => $interdicao->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
