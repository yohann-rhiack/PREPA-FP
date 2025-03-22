<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Matières';
        // $schools = School::all();
        return view('frontend.matiere', compact('title'));
    }
}
