<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TipoInterdicao;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interdicao extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'titulo',
        'descricao',
        'latitude',
        'longitude',
        'tipo',
        'data_inicio',
        'data_fim',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'tipo' => TipoInterdicao::class,
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function getIsAtivoAttribute(): bool
    {
        $now = now();

        return $this->data_inicio <= $now && (is_null($this->data_fim) || $this->data_fim > $now);
    }
}
