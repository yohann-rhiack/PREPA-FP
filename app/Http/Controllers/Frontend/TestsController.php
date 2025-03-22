<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Tests';
        // $schools = School::all();
        return view('frontend.test', compact('title'));
    }
}
