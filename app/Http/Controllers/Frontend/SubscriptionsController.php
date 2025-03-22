<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index()
    {
        $title = 'Gestionnaire des Abonnements';
        // $schools = School::all();
        return view('frontend.abonnement', compact('title'));
    }

}
