<?php

namespace Mesa\Http\Controllers;

use Mesa\Models\Contract;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * Render the homepage.
     *
     * @return mixed
     */
    public function index()
    {
        // dd(session()->all());
        $contracts = Contract::count();

        return view('home', compact('contracts'));
    }
}
