<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propios = Auth::user()->ownedProjects;
        $participando = Auth::user()->projects;

        return view('projects.index', compact('propios', 'participando'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'deadline' => 'required|date',
            'status' => 'required|in:pendiente,en progreso,finalizado',
        ]);

        Project::create(array_merge($datos, [
            'user_id' => Auth::id()
        ]));

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        Gate::authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        Gate::authorize('update', $project);

        $datos = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'deadline' => 'required|date',
            'status' => 'required|in:pendiente,en progreso,finalizado',
        ]);

        $project->update($datos);

        return redirect()->route('projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Gate::authorize('delete', $project);
        $project->delete();

        return redirect()->route('projects.index');
    }
}
