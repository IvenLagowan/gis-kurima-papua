<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Wisata;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $wisata = Tour::all();
        return view('home', compact('wisata'));
    }
}
