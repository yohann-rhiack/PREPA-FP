<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Plans';
        // $schools = School::all();
        return view('frontend.plan', compact('title'));
    }
}
