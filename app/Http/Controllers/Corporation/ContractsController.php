<?php

namespace App\Http\Controllers\Corporation;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Contract;

class ContractsController extends Controller
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
     * @return RedirectResponse
     */
    public function updateContractsFromEsi(): RedirectResponse
    {
        $this->esi->updateDataAccessContracts();
        return redirect()->back();
    }
}
