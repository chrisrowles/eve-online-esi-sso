<?php

namespace Mesa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class WalletJournal extends Model
{
    protected $table = 'wallet_journal';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('created_at_desc', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    public function division()
    {
        return $this->belongsTo(WalletDivision::class, 'division_id', 'division_id');
    }

    public function transaction()
    {
        return $this->belongsTo(WalletTransaction::class, 'journal_ref_id', 'journal_id');
    }
}
