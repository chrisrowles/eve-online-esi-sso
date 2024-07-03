<?php

namespace Mesa\Http\Controllers\Corporation;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Mesa\Models\WalletJournal;

class FinanceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $finances['ledger'] = $this->esi->buildCorporateLedger();
        $finances['journal'] = WalletJournal::with('division')->get();
        $finances['total'] = 0;

        foreach ($finances['ledger'] as $division)
        {
            $finances['total'] += $division->balance;
        }

        return view('management.finances', compact('finances'));
    }

    /**
     * Update journal transactions from the ESI.
     *
     * @return RedirectResponse
     */
    public function updateJournalTransactionsFromEsi(): RedirectResponse
    {
        $this->esi->updateDataAccessJournalTransactions();
        return redirect()->back();
    }
}
