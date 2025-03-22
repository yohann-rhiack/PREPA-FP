<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Cours';
        // $schools = School::all();
        return view('frontend.cours', compact('title'));
    }
}
