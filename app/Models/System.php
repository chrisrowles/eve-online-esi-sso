<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};


class System extends Model
{
    /** @var string $table */
    protected $table = "systems";

    /**
     * Constellations relation.
     *
     * @return BelongsTo
     */
    public function constellation(): BelongsTo
    {
        return $this->belongsTo(Constellation::class);
    }

    /**
     * Stargates relation.
     *
     * @return HasMany
     */
    public function stargates(): HasMany
    {
        return $this->hasMany(Stargate::class);
    }

    /**
     * Stations relation.
     *
     * @return HasMany
     */
    public function stations(): hasMany
    {
        return $this->hasMany(Station::class);
    }
}
