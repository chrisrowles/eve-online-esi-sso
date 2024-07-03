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
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateOrderHistoryFromEsi(Request $request): RedirectResponse
    {
        $orders = $this->esi->updateDataAccessOrderHistory();

        if ($orders['errors'] > 0)
        {
            $request->session()->flash('error', 'Could not update order history from the ESI, please check the logs.');
        } else {
            $request->session()->flash('success', $orders['total'] . ' orders successfully updated');
        }

        return redirect()->back();
    }
}
