<?php

namespace App\Http\Controllers\Corporation;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\WalletJournal;

class FinanceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $finances['balances'] = $this->esi->buildCorporateBalances();
        $finances['journal'] = WalletJournal::with('division')->get();
        $finances['total'] = 0;

        foreach ($finances['balances'] as $division)
        {
            $finances['total'] += $division->balance;
        }

        return view('corporation.finances', compact('finances'));
    }

    /**
     * Update journal transactions from the ESI.
     *
     * @return RedirectResponse
     */
    public function updateJournalTransactionsFromESI(): RedirectResponse
    {
        $this->esi->updateDataAccessJournalTransactions();
        return redirect()->back();
    }
}
