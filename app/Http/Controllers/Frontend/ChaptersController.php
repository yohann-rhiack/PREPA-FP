<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChaptersController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Chapitres';
        // $schools = School::all();
        return view('frontend.chapitre', compact('title'));
    }
}
