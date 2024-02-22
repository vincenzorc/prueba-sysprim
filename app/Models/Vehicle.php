<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'year',
        'color',
        'date_entry',
        'mark_id',
        'type_id'
    ];

    public function mark(): BelongsTo
    {
        return $this->belongsTo(Mark::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
