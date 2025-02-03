<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DemandeConge extends Model
{
    /** @use HasFactory<\Database\Factories\DemandeCongeFactory> */
    use HasFactory, HasUuids;

    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class);
    }

    public function statutDemande(): BelongsTo
    {
        return $this->belongsTo(StatutDemande::class);
    }
}
