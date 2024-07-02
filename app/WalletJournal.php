<?php

namespace Mesa;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Mesa\WalletJournal
 *
 * @property int $id
 * @property string $division_id
 * @property string $journal_id
 * @property string $ref_type
 * @property string $description
 * @property string $amount
 * @property string $balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Mesa\WalletDivision $division
 * @property-read \Mesa\WalletTransaction $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal query()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal whereJournalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal whereRefType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletJournal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
