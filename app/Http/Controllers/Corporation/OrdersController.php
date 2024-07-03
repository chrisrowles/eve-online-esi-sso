<?php

namespace App\Http\Controllers\Corporation;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\OrderHistory;

class OrdersController extends Controller
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
