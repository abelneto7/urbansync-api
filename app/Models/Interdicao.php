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
        'status',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'status' => 'boolean',
        'tipo' => TipoInterdicao::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
