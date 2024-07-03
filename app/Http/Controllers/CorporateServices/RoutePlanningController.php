<?php

namespace Mesa\Http\Controllers\CorporateServices;

use Mesa\Models\System;

class RoutePlanningController extends BaseController
{
    /**
     * Render the route planner page.
     *
     * @return mixed
     */
    public function index()
    {
        $systems = System::all(['system_id', 'name'])->sortBy('name');

        return view('route.planner', compact('systems'));
    }

    /**
     * Plan a route.
     *
     * @param $origin
     * @param $destination
     */
    public function planRoute($origin, $destination)
    {
        $route = $this->esi->planJourneyRoute($origin, $destination);
        if ($route)
        {
            dd($route);
        } else {
            dd($route);
        }
    }
}
