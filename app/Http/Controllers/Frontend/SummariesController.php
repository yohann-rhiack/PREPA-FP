<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SummariesController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Resumés';
        // $schools = School::all();
        return view('frontend.resume', compact('title'));
    }
}
