<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $proyectosCreados = Auth::user()->ownedProjects()->count();

        $proyectosParticipando = Auth::user()->projects()->count();

        return view('dashboard', compact('proyectosCreados', 'proyectosParticipando'));
    }
}
