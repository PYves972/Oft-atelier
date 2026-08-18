<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Session;
use App\Models\Training;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $trainingsCount = Training::count();
        $sessionsCount = Session::count();
        $reservationsCount = Reservation::count();
        $membersCount = User::where('role', 'member')->count();

        $latestReservations = Reservation::with(['user', 'session.training'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'trainingsCount',
            'sessionsCount',
            'reservationsCount',
            'membersCount',
            'latestReservations'
        ));
    }
}
