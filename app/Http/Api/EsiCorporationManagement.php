<?php

namespace App\Http\Api;

use Illuminate\Support\Facades\Log;
use App\Models\Station;
use App\Models\Contract;
use App\Models\OrderHistory;
use App\Models\WalletJournal;
use App\Models\WalletTransaction;
use App\Http\Api\EsiClient;

/**
 * ESI Corporation Management.
 */
class EsiCorporationManagement extends EsiClient
{
    /** @var mixed $id */
    public $id;

    /** @var mixed $name */
    public $name;

    /** @var array $data */
    protected array $data = [];

    /**
     * EsiCorporationManagement constructor.
     *
     * @param array $character
     */
    public function __construct(array $character)
    {
        $this->setURL(config('eve.esi.api_uri'));

        $this->id = $character['id'];
        $this->name = $character['name'];

        parent::__construct();
    }

    /**
     * Build corporation balances.
     *
     * @param bool $withTransactionJournal
     * @return mixed
     */
    public function buildCorporateBalances($withTransactionJournal = false, $fromDataAccess = false)
    {
        $divisions = $this->fetchCorporateDivisions('wallet');
        $balances = $this->fetchCorporateBalances();

        if ($divisions && $balances)
        {
            foreach ($divisions as $division)
            {
                foreach ($balances as $x => $balance)
                {
                    if ($balance->division === $division->division)
                    {
                        $divisions[$x]->balance = $balance->balance;

                        if ($withTransactionJournal)
                        {
                            if ($fromDataAccess)
                            {
                                $divisions[$x]->transactions = WalletTransaction::where(
                                    'division_id',
                                    $balance->division
                                )->get()->toArray();

                                $divisions[$x]->journal = WalletJournal::where(
                                    'division_id',
                                    $balance->division
                                )->get()->toArray();
                            } else {
                                $divisions[$x]->transactions = $this->fetchCorporateTransactions($balance->division);
                                $divisions[$x]->journal = $this->fetchCorporateJournal($balance->division);
                            }
                        }
                    }
                }
            }

            $divisions[0]->name = 'Master Division';

            return $divisions;
        }

        return false;
    }

    /**
     * Fetch corporation divisions.
     *
     * @param null $type
     * @return bool|mixed
     */
    public function fetchCorporateDivisions($type = null)
    {
        $divisions = $this->fetch('/corporations/' . config('eve.esi.corporation') . '/divisions');

        if (!is_null($type))
        {
            $divisions = $divisions->{$type} ?? $divisions;
        }

        return $divisions;
    }

    /**
     * Fetch corporation balances.
     *
     * @return bool|mixed
     */
    public function fetchCorporateBalances()
    {
        return $this->fetch('/corporations/'
            . config('eve.esi.corporation')
            . '/wallets');
    }

    /**
     * Fetch corporation journal
     *
     * @param $division
     * @return bool|mixed
     */
    public function fetchCorporateJournal($division)
    {
        return $this->fetch('/corporations/'
            . config('eve.esi.corporation')
            . '/wallets/' . $division . '/journal');
    }

    /**
     * Fetch corporation transactions
     *
     * @param $division
     * @return bool|mixed
     */
    public function fetchCorporateTransactions($division)
    {
        return $this->fetch('/corporations/'
            . config('eve.esi.corporation')
            . '/wallets/' . $division . '/transactions');
    }

    /**
     * Fetch corporation order history.
     *
     * @return mixed
     */
    public function fetchCorporateOrderHistory()
    {
        return $this->fetch('/corporations/'
            . config('eve.esi.corporation')
            . '/orders/history');
    }

    /**
     * Update order history.
     *
     * @param mixed $orders
     */
    public function updateDataAccessOrderHistory($orders = null): array
    {
        if (is_null($orders))
        {
            $orders = $this->fetchCorporateOrderHistory();
        }

        $count = 0;
        $total = 0;
        $errors = 0;

        if ($orders)
        {
            $total = count($orders);
            foreach ($orders as $order)
            {
                if (OrderHistory::where('order_id', $order->order_id)->first() === null)
                {
                    $model = new OrderHistory();

                    $model->escrow = $order->escrow ?? 0;
                    $model->is_buy_order = $order->is_buy_order ?? false;
                    $model->created_at = $order->issued;
                    $model->updated_at = $order->issued;
                    $model->issued_by = $order->issued_by;
                    $model->location_id = $order->location_id;
                    $model->order_id = $order->order_id;
                    $model->price = $order->price;
                    $model->region_id = $order->region_id;
                    $model->state = $order->state;
                    $model->type_id = $this->fetch('/universe/types/'.$order->type_id)->name ?? $order->type_id;
                    $model->volume_min = $order->min_volume ?? 0;
                    $model->volume_remain = $order->volume_remain ?? 0;
                    $model->volume_total = $order->volume_total ?? 0;
                    $model->wallet_division = $order->wallet_division;

                    if ($model->save())
                    {
                        ++$count;
                    } else {
                        ++$errors;
                        Log::error('Failed to import order: ' . $order->order_id);
                    }
                } else {
                    --$total;
                }
            }
        } else {
            ++$errors;
        }

        return [
            'succeeded' => $count,
            'total' => $total,
            'errors' => $errors
        ];
    }

    /**
     * Update journals and transactions.
     *
     * @param mixed $balances
     */
    public function updateDataAccessJournalTransactions($balances = null)
    {
        if (is_null($balances)) {
            $balances = $this->buildCorporateBalances(true);
        }

        foreach ($balances as $division) {
            $id = $division->division;

            foreach ($division->journal as $row) {
                if (! WalletJournal::whereJournalId($row->id)->exists()) {
                    $model = new WalletJournal();

                    $model->division_id = $id;
                    $model->journal_id = $row->id;
                    $model->ref_type = $row->ref_type;
                    $model->amount = $row->amount;
                    $model->balance = $row->balance;
                    $model->description = $row->description;
                    $model->created_at = $row->date;
                    $model->updated_at = $row->date;

                    $model->save();
                }
            }

            foreach ($division->transactions as $row) {
                if (! WalletTransaction::whereTransactionId($row->transaction_id)->exists()) {
                    $model = new WalletTransaction();

                    $model->division_id = $id;
                    $model->transaction_id = $row->transaction_id;
                    $model->type_id = $row->type_id;
                    $model->client_id = $row->client_id;
                    $model->is_buy = $row->is_buy;
                    $model->journal_ref_id = $row->journal_ref_id;
                    $model->location_id = $row->location_id;
                    $model->quantity = $row->quantity;
                    $model->unit_price = $row->unit_price;
                    $model->created_at = $row->date;
                    $model->updated_at = $row->date;

                    $model->save();
                }
            }
        }
    }

    /**
     * Update corporation contracts.
     *
     * @return array
     */
    public function updateDataAccessContracts(): array
    {
        $contracts = $this->fetch('/corporations/' . config('eve.esi.corporation') . '/contracts');
        $count = 0;
        $total = 0;
        $errors = 0;

        if ($contracts)
        {
            $total = count($contracts);
            foreach ($contracts as $contract)
            {
                $model = Contract::where('esi_contract_id', $contract->contract_id)->first();
                if ($model === null)
                {
                    $model = new Contract;
                    $model->esi_contract_id = $contract->contract_id;
                    $model->volume = $contract->volume;
                    $model->type = $contract->type;
                    $model->availability = $contract->availability;
                    $model->days_to_complete = $contract->days_to_complete;
                    $model->issuer_id = $contract->issuer_id;

                    if ($contract->type === "courier")
                    {
                        $model->reward = $contract->reward;
                        $model->collateral = $contract->collateral;
                        $model->start_location_id = $contract->start_location_id;
                        $model->end_location_id = $contract->end_location_id;
                    }

                    $model->date_issued = date('Y-m-d H:i:s', strtotime($contract->date_issued));

                    $model->date_expires = date('Y-m-d H:i:s', strtotime($model->date_issued . '+ '
                        . $model->days_to_complete . ' days'));

                    $model->date_accepted = isset($contract->date_accepted)
                        ? date('Y-m-d H:i:s', strtotime($contract->date_accepted)) : null;
                }

                $model->date_completed = isset($contract->date_completed)
                    ? date('Y-m-d H:i:s', strtotime($contract->date_completed)) : null;

                $model->status = $contract->status;

                if ($model->save())
                {
                    $this->updateDataAccessStationsFromContract($model);
                    ++$count;
                } else {
                    ++$errors;
                    Log::error('Failed to import contract: ' . $contract->contract_id);
                }
            }
        } else {
            ++$errors;
        }

        return [
            'succeeded' => $count,
            'total' => $total,
            'errors' => $errors
        ];
    }

    /**
     * Update stations from corporation contracts.
     *
     * @param Contract $contract
     * @return void
     */
    public function updateDataAccessStationsFromContract(Contract $contract)
    {
        if ($contract->type === "courier")
        {
            $start_id = $contract->start_location_id;
            $end_id = $contract->end_location_id;

            $stations = [];
            if (is_32bit_signed_int($start_id))
            {
                $stations[] = $this->fetch('/universe/stations/' . $start_id);
            }

            if (is_32bit_signed_int($end_id))
            {
                $stations[] = $this->fetch('/universe/stations/' . $end_id);
            }

            foreach ($stations as $station)
            {
                if ($station) {
                    if (! Station::whereStationId($station->station_id)->exists()) {
                        $model = new Station();
                        $model->system_id = $station->system_id;
                        $model->station_id = $station->station_id;
                        $model->name = $station->name;
                        $model->max_dock_ship_volume = $station->max_dockable_ship_volume;

                        if (!$model->save()) {
                            Log::error('Failed to import station ' . $station->station_id);
                        }
                    }
                }
            }
        }
    }
}
