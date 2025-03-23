<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Reponse';
        $answers = Answer::all();
        return view('frontend.reponse', compact('title', 'answers'));
    }

}
