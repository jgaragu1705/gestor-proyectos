<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectMemberController extends Controller
{
    public function store(Request $request, Project $project)
    {
        Gate::authorize('update', $project);

        $datos = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required',
            'contribution_hours' => 'nullable|numeric|min:0',
        ]);

        if ($datos['user_id'] == $project->user_id) {
            return redirect()->route('projects.show', $project);
        }

        if ($project->members()->where('user_id', $datos['user_id'])->exists()) {
            return redirect()->route('projects.show', $project);
        }

        $project->members()->attach($datos['user_id'], [
            'role' => $datos['role'],
            'contribution_hours' => $datos['contribution_hours'] ?? 0
        ]);

        return redirect()->route('projects.show', $project);
    }

    public function update(Request $request, Project $project, User $user)
    {
        Gate::authorize('update', $project);

        $datos = $request->validate([
            'role' => 'required',
            'contribution_hours' => 'required|numeric|min:0',
        ]);

        $project->members()->updateExistingPivot($user->id, [
            'role' => $datos['role'],
            'contribution_hours' => $datos['contribution_hours']
        ]);

        return redirect()->route('projects.show', $project);
    }

    public function destroy(Project $project, User $user)
    {
        Gate::authorize('update', $project);

        $project->members()->detach($user->id);

        return redirect()->route('projects.show', $project);
    }
}
