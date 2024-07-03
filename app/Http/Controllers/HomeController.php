<?php

namespace App\Http\Controllers;

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
        return view('home');
    }
}
