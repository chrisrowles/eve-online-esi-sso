<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $systems = System::all();
        return view('route.planner', compact('systems'));
    }

    public function plan(Request $request)
    {
        $route = $this->esi->fetchRoute(
            $request->get('origin'),
            $request->get('destination')
        );

        return view('route.journey', compact('route'));
    }
}
