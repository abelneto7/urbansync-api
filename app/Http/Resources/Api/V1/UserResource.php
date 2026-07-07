<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->name,
            'email' => $this->email,
            'perfis' => $this->whenLoaded('profiles', function () {
                return $this->profiles->map(function ($profile) {
                    return [
                        'id' => $profile->id,
                        'name' => $profile->name,
                    ];
                });
            }),
            'permissoes' => $this->whenLoaded('profiles', function () {
                return $this->profiles
                    ->flatMap(fn($p) => $p->permissions)
                    ->pluck('name')
                    ->unique()
                    ->values()
                    ->toArray();
            }),
            'criado_em' => $this->created_at?->format('Y-m-d H:i:s'),
            'atualizado_em' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
