<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CyclesController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Cycles';
        // $schools = School::all();
        return view('frontend.cycle', compact('title'));
    }
}
