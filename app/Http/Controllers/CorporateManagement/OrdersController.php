<?php

namespace Mesa\Http\Controllers\CorporateManagement;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Mesa\Models\OrderHistory;

class OrdersController extends BaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $finances['orders'] = OrderHistory::with('division')->get();
        $finances['ledger'] = $this->esi->buildCorporateLedger();
        $finances['total'] = 0;

        foreach ($finances['ledger'] as $division)
        {
            $finances['total'] += $division->balance;
        }

        return view('management.order-history', compact('finances'));
    }

    /**
     * Update order history from the ESI.
     *
     * @return RedirectResponse
     */
    public function updateOrderHistoryFromEsi(): RedirectResponse
    {
        $this->esi->updateDataAccessOrderHistory();
        return redirect()->back();
    }
}
