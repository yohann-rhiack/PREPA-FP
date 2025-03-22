<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttemptsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Tentatives';
        // $schools = School::all();
        return view('frontend.tentative', compact('title'));
    }
}
