<?php

namespace Mesa\Models;

use Illuminate\Database\Eloquent\{Model, Builder};
use Illuminate\Database\Eloquent\Relations\HasMany;


class Region extends Model
{
    /** @var string $table */
    protected $table = "regions";

    /**
     * Bootstrap the model.
     *
     * @return void;
     */
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('default_sort', function (Builder $qb) {
            $qb->orderBy('name', 'asc');
        });
    }

    /**
     * Constellations relation.
     *
     * @return HasMany
     */
    public function constellations(): HasMany
    {
        return $this->hasMany(Constellation::class);
    }
}
