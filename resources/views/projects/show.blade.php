<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                Detalle del proyecto
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Consulta la información y los participantes del proyecto.
            </p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-8">

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6">
                <p class="font-semibold mb-2">No se han podido guardar los cambios:</p>
                @foreach ($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-5">
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-indigo-600 mb-2">
                        Información del proyecto
                    </p>

                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 break-words">
                        {{ $project->title }}
                    </h3>

                    <p class="text-gray-500 mt-3 leading-relaxed">
                        {{ $project->description ?: 'Sin descripción disponible.' }}
                    </p>
                </div>

                <div class="shrink-0">
                    <x-status-badge :status="$project->status" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-8 pt-6 border-t border-gray-100">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                            Fecha límite
                        </p>
                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $project->deadline->format('d/m/Y') }}
                        </p>

                        @if ($project->isOverdue())
                            <p class="text-xs font-semibold text-red-600 mt-1">
                                Proyecto vencido
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2m16 0v-2a4 4 0 00-3-3.87M14 3.13a4 4 0 010 7.75M10 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">
                            Propietario
                        </p>
                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $project->owner->name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <x-members-table :project="$project" />

        @can('update', $project)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">
                        Añadir participante
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Incorpora a otro usuario y define su rol y sus horas de contribución.
                    </p>
                </div>

                @if ($usuariosDisponibles->isNotEmpty())
                    <form method="POST" action="{{ route('projects.members.store', $project) }}"
                          class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 items-end">
                        @csrf

                        <div>
                            <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Usuario
                            </label>

                            <select
                                id="user_id"
                                name="user_id"
                                required
                                class="w-full border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                @foreach ($usuariosDisponibles as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                Rol
                            </label>

                            <select
                                id="role"
                                name="role"
                                required
                                class="w-full border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                                @foreach (\App\Models\Project::ROLES as $rol)
                                    <option value="{{ $rol }}" {{ old('role', \App\Models\Project::ROLES[0]) === $rol ? 'selected' : '' }}>
                                        {{ $rol }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="contribution_hours" class="block text-sm font-semibold text-gray-700 mb-2">
                                Horas de contribución
                            </label>

                            <input
                                type="number"
                                id="contribution_hours"
                                name="contribution_hours"
                                value="{{ old('contribution_hours', 0) }}"
                                min="0"
                                max="10000"
                                step="0.01"
                                placeholder="0"
                                class="w-full border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >
                        </div>

                        <div>
                            <button type="submit"
                                    class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition font-semibold w-full">
                                + Añadir participante
                            </button>
                        </div>
                    </form>
                @else
                    <div class="bg-gray-50 rounded-xl p-5 text-center">
                        <p class="text-sm font-medium text-gray-700">
                            No hay usuarios disponibles para añadir.
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Todos los usuarios registrados ya participan en este proyecto o son su propietario.
                        </p>
                    </div>
                @endif
            </div>
        @endcan

        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-4 pt-2">
            <a href="{{ route('projects.index') }}"
               class="text-center text-gray-600 hover:text-indigo-700 font-medium transition">
                ← Volver a proyectos
            </a>

            <div class="flex flex-col sm:flex-row gap-3">
                @can('update', $project)
                    <a href="{{ route('projects.edit', $project) }}"
                       class="text-center bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition font-semibold">
                        Editar proyecto
                    </a>
                @endcan

                @can('delete', $project)
                    <form method="POST" action="{{ route('projects.destroy', $project) }}"
                          onsubmit="return confirm('¿Seguro que quieres eliminar este proyecto?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="w-full bg-red-50 text-red-700 px-5 py-2.5 rounded-lg hover:bg-red-100 transition font-semibold">
                            Eliminar proyecto
                        </button>
                    </form>
                @endcan
            </div>
        </div>

    </div>
</x-app-layout>