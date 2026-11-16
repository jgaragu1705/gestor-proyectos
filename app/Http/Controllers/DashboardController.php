<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $usuario = Auth::user();

        $proyectosCreados = $usuario->ownedProjects()->count();

        $proyectosParticipando = $usuario->projects()->count();

        $horasAportadas = $usuario->projects()->sum('project_user.contribution_hours');

        $proyectosRecientes = $usuario->ownedProjects()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->merge(
                $usuario->projects()
                    ->orderBy('projects.created_at', 'desc')
                    ->take(5)
                    ->get()
            )
            ->unique('id')
            ->sortByDesc('created_at')
            ->take(5)
            ->values();

        $proximosVencimientos = $usuario->ownedProjects()
            ->whereDate('deadline', '>=', today())
            ->orderBy('deadline')
            ->take(5)
            ->get()
            ->merge(
                $usuario->projects()
                    ->whereDate('projects.deadline', '>=', today())
                    ->orderBy('projects.deadline')
                    ->take(5)
                    ->get()
            )
            ->unique('id')
            ->sortBy('deadline')
            ->take(5)
            ->values();

        return view('dashboard', compact(
            'proyectosCreados',
            'proyectosParticipando',
            'horasAportadas',
            'proyectosRecientes',
            'proximosVencimientos'
        ));
    }
}
