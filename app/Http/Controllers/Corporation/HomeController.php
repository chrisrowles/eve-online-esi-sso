<?php

namespace Mesa\Http\Controllers\Corporation;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Mesa\Models\Application;
use Mesa\Models\Contract;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function index()
    {
        $contracts = Contract::where('type','courier')
            ->where('status', '!=', 'deleted')
            ->get();

        $finances['ledger'] = $this->esi->buildCorporateLedger();
        $finances['total'] = 0;
    
        foreach ($finances['ledger'] as $division)
        {
            $finances['total'] += $division->balance;
        }

        $applications = Application::all();

        return view('management.home', compact('contracts', 'finances', 'applications'));
    }
}
