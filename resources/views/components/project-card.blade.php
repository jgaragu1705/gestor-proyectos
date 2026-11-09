@props(['project', 'role' => null])

<div class="bg-white p-6 rounded-xl shadow">

    <h4 class="text-xl font-bold mb-2">
        {{ $project->title }}
    </h4>

    <p class="text-sm text-gray-500">
        {{ $project->description }}
    </p>

    <p class="text-sm text-gray-500 mt-2">
        Fecha límite: {{ $project->deadline->format('d/m/Y') }}
    </p>

    @if ($role)
        <p class="text-sm text-gray-500 mt-1">
            Mi rol: {{ $role }}
        </p>
    @endif

    <x-status-badge :status="$project->status" />

    <p class="mt-4">
        <a href="{{ route('projects.show', $project) }}"
           class="text-indigo-600 hover:text-indigo-800">
            Ver detalles
        </a>
    </p>

</div>