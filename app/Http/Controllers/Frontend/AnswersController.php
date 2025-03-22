<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Reponse';
        // $schools = School::all();
        return view('frontend.reponse', compact('title'));
    }
}
