<?php

namespace Mesa\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $table = 'order_history';

    public function division()
    {
        return $this->belongsTo(WalletDivision::class, 'wallet_division', 'division_id');
    }
}
