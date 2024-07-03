<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Station extends Model
{
    /** @var string $table */
    protected $table = "stations";

    /**
     * Systems relation.
     *
     * @return BelongsTo
     */
    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }
}
