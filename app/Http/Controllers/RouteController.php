<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index(Request $request)
    {
        $systems = System::all();

        if ($this->isApi($request)) {
            return response()->json($systems);
        }

        return view('route.planner', compact('systems'));
    }

    public function plan(Request $request)
    {
        $systems = System::all();

        $route = $this->esi->fetchRoute(
            $request->get('origin'),
            $request->get('destination')
        );

        if ($this->isApi($request)) {
            return response()->json($route);
        }

        return view('route.journey', compact('route', 'systems'));
    }
}
