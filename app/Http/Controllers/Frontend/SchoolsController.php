<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire Ecoles';
        // $schools = School::all();
        return view('frontend.ecole', compact('title'));
    }
}
