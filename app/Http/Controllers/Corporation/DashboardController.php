<?php

namespace App\Http\Controllers\Corporation;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Models\Application;
use App\Models\WalletJournal;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
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

        $applications = Application::all();

        return view('corporation.dashboard', compact('finances', 'applications'));
    }
}
