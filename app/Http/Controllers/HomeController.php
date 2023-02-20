<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function home(Request $request): view
    {
        return view('home', [
            'title' => 'Homepagina',
        ]);
    }
}
