<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};


class Contract extends Model
{
    /** @var string $table */
    protected $table = "contracts";

    /** @var bool $timestamps */
    public $timestamps = false;
}
