<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class WalletTransaction extends Model
{
    protected $table = 'wallet_transactions';

    public function division()
    {
        return $this->belongsTo(WalletDivision::class, 'division_id', 'division_id');
    }

    public function journal()
    {
        return $this->hasOne(WalletJournal::class, 'journal_id', 'journal_ref_id');
    }
}
