@props(['project', 'role' => null])

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-200">
    <div class="flex justify-between items-start gap-3 mb-3">
        <h4 class="text-xl font-bold text-gray-800 break-words">
            {{ $project->title }}
        </h4>

        <x-status-badge :status="$project->status" />
    </div>

    <p class="text-sm text-gray-500 leading-relaxed">
        {{ $project->description ?: 'Sin descripción disponible.' }}
    </p>

    <div class="mt-4 space-y-2">
        <p class="text-sm text-gray-500">
            Fecha límite: {{ $project->deadline->format('d/m/Y') }}
        </p>

        @if ($project->isOverdue())
            <p class="text-sm font-semibold text-red-600">
                Proyecto vencido
            </p>
        @endif

        <p class="text-sm text-gray-500">
            Participantes: {{ $project->members_count }}
        </p>

        @if ($role)
            <p class="text-sm text-gray-500">
                Mi rol: {{ $role }}
            </p>

            <p class="text-sm text-gray-500">
                Propietario: {{ $project->owner->name }}
            </p>
        @endif
    </div>

    <div class="mt-5 pt-4 border-t border-gray-100">
        <a href="{{ route('projects.show', $project) }}"
           class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition">
            Ver detalles →
        </a>
    </div>
</div>
