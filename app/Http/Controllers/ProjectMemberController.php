<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ProjectMemberController extends Controller
{
    public function store(Request $request, Project $project)
    {
        Gate::authorize('update', $project);

        $datos = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => ['required', Rule::in(Project::ROLES)],
            'contribution_hours' => 'nullable|numeric|min:0',
        ]);

        if ($datos['user_id'] == $project->user_id) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'El propietario ya pertenece al proyecto.');
        }

        if ($project->members()->where('user_id', $datos['user_id'])->exists()) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'Este usuario ya participa en el proyecto.');
        }

        $project->members()->attach($datos['user_id'], [
            'role' => $datos['role'],
            'contribution_hours' => $datos['contribution_hours'] ?? 0
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Participante añadido correctamente.');
    }

    public function update(Request $request, Project $project, User $user)
    {
        Gate::authorize('update', $project);

        if (!$project->members()->whereKey($user->id)->exists()) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'Este usuario no pertenece al proyecto.');
        }

        $datos = $request->validate([
            'role' => ['required', Rule::in(Project::ROLES)],
            'contribution_hours' => 'required|numeric|min:0',
        ]);

        $project->members()->updateExistingPivot($user->id, [
            'role' => $datos['role'],
            'contribution_hours' => $datos['contribution_hours']
        ]);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Participante actualizado correctamente.');
    }

    public function destroy(Project $project, User $user)
    {
        Gate::authorize('update', $project);

        if (!$project->members()->whereKey($user->id)->exists()) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'Este usuario no pertenece al proyecto.');
        }

        $project->members()->detach($user->id);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Participante eliminado correctamente.');
    }
}
