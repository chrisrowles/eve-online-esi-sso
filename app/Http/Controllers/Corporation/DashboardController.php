<?php

namespace App\Http\Controllers\Corporation;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Models\Application;
use App\Models\Contract;

class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function index()
    {
        $contracts = Contract::where('type','courier')
            ->where('status', '!=', 'deleted')
            ->get();

        $finances['balances'] = $this->esi->buildCorporateBalances();
        $finances['total'] = 0;
    
        foreach ($finances['balances'] as $division)
        {
            $finances['total'] += $division->balance;
        }

        $applications = Application::all();

        return view('management.home', compact('contracts', 'finances', 'applications'));
    }
}
