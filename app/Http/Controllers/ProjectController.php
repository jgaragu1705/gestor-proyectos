<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    private function validationRules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'deadline' => 'required|date',
            'status' => ['required', Rule::in(Project::STATUSES)],
        ];
    }

    public function index()
    {
        $propios = Auth::user()->ownedProjects()
            ->withCount('members')
            ->get();

        $participando = Auth::user()->projects()
            ->with('owner')
            ->withCount('members')
            ->get();

        return view('projects.index', compact('propios', 'participando'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate($this->validationRules());

        Project::create(array_merge($datos, [
            'user_id' => Auth::id(),
        ]));

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto creado correctamente.');
    }

    public function show(Project $project)
    {
        $project->load(['members', 'owner']);

        $miembros = $project->members->pluck('id')->toArray();

        $usuariosDisponibles = User::whereNotIn(
            'id',
            array_merge($miembros, [$project->user_id])
        )->get();

        return view('projects.show', compact('project', 'usuariosDisponibles'));
    }

    public function edit(Project $project)
    {
        Gate::authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        Gate::authorize('update', $project);

        $datos = $request->validate($this->validationRules());

        $project->update($datos);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy(Project $project)
    {
        Gate::authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto eliminado correctamente.');
    }
}
