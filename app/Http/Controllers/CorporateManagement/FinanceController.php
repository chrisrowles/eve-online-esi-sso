<?php

namespace Mesa\Http\Controllers\CorporateManagement;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Mesa\Models\WalletJournal;

class FinanceController extends BaseController
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateJournalTransactionsFromEsi(Request $request): RedirectResponse
    {
        $this->esi->updateDataAccessJournalTransactions();

        $request->session()->flash('success', 'Financial journals and transactions successfully updated.');

        return redirect()->back();
    }
}
