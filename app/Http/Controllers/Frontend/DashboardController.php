<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Subscription;

class DashboardController extends Controller
{

    public function dashboard()
    {  
        // Récupérer les données nécessaires

        $testsCount = Test::count();
        $usersCount = User::count();
        $quizzesCount = Quiz::count();
        $subscriptionsCount = Subscription::count();
        $title = 'Dashboard Administrateur';

        
        return view('frontend.admin-dashboard', compact('title', 'testsCount', 'usersCount', 'quizzesCount', 'subscriptionsCount'));
    }
}
