<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class WalletDivision extends Model
{
    protected $table = 'wallet_divisions';

    public function journal()
    {
        return $this->hasMany(WalletJournal::class, 'division_id', 'division_id');
    }

    public function orders()
    {
        return $this->hasMany(OrderHistory::class, 'wallet_division', 'division_id');
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class, 'division_id', 'division_id');
    }
}
