<?php

namespace Mesa\Http\Controllers\CorporateManagement;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Mesa\Models\Contract;
use Illuminate\Http\Request;

class ContractsController extends BaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $contracts = Contract::where('type', 'courier')->get();

        return view('management.contracts', compact('contracts'));
    }

    /**
     * Update contracts from the ESI.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function updateContractsFromEsi(Request $request): RedirectResponse
    {
        $contracts = $this->esi->updateDataAccessContracts();
        if ($contracts['errors'] > 0)
        {
            $request->session()->flash('error', 'Could not fetch contracts from the ESI, please check the logs.');
        } else {
            $request->session()->flash('success', $contracts['total'] . ' contracts successfully updated');
        }

        return redirect()->back();
    }
}
