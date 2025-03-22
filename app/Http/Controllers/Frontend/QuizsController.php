<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Question';
        // $schools = School::all();
        return view('frontend.question', compact('title'));
    }
}
