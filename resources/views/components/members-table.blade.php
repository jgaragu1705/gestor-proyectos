@props(['project'])

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="px-6 py-5 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-800">
            Participantes del proyecto
        </h3>
        <p class="text-sm text-gray-500 mt-1">
            Personas que colaboran y sus contribuciones.
        </p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-semibold">Participante</th>
                    <th class="px-6 py-4 font-semibold">Rol</th>
                    <th class="px-6 py-4 font-semibold">Horas de contribución</th>
                    @can('update', $project)
                        <th class="px-6 py-4 font-semibold text-right">Acciones</th>
                    @endcan
                </tr>
            </thead>

            @forelse ($project->members as $miembro)
                <tbody x-data="{ editing: false }" class="border-b border-gray-100 last:border-b-0">
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="px-6 py-5">
                            <p class="font-semibold text-gray-800">
                                {{ $miembro->name }}
                            </p>

                            @can('update', $project)
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $miembro->email }}
                                </p>
                            @endcan
                        </td>

                        <td class="px-6 py-5">
                            <span class="inline-flex items-center bg-indigo-50 text-indigo-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                {{ $miembro->pivot->role }}
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            <span class="text-sm font-semibold text-gray-700 tabular-nums">
                                {{ number_format($miembro->pivot->contribution_hours, 2, ',', '.') }} h
                            </span>
                        </td>

                        @can('update', $project)
                            <td class="px-6 py-5">
                                <div class="flex justify-end items-center gap-3">
                                    <button
                                        type="button"
                                        @click="editing = !editing"
                                        :aria-expanded="editing.toString()"
                                        class="bg-indigo-50 text-indigo-700 px-3 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-100 transition"
                                    >
                                        <span x-text="editing ? 'Cerrar' : 'Editar'"></span>
                                    </button>

                                    <form method="POST" action="{{ route('projects.members.destroy', [$project, $miembro]) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('¿Seguro que quieres eliminar a este participante?')"
                                            class="text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg text-sm font-semibold transition"
                                        >
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endcan
                    </tr>

                    @can('update', $project)
                        <tr x-show="editing" style="display: none;">
                            <td colspan="4" class="px-6 py-6 bg-indigo-50/40 border-t border-gray-100">
                                <div class="mb-4">
                                    <h4 class="font-semibold text-gray-800">
                                        Editar participante
                                    </h4>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Modifica su rol y sus horas de contribución.
                                    </p>
                                </div>

                                <form
                                    method="POST"
                                    action="{{ route('projects.members.update', [$project, $miembro]) }}"
                                    class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <div>
                                        <label for="role_{{ $miembro->id }}" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Rol
                                        </label>

                                        <select
                                            id="role_{{ $miembro->id }}"
                                            name="role"
                                            required
                                            class="w-full border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                            @foreach (\App\Models\Project::ROLES as $rol)
                                                <option value="{{ $rol }}" {{ $miembro->pivot->role === $rol ? 'selected' : '' }}>
                                                    {{ $rol }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="hours_{{ $miembro->id }}" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Horas de contribución
                                        </label>

                                        <input
                                            type="number"
                                            id="hours_{{ $miembro->id }}"
                                            name="contribution_hours"
                                            value="{{ $miembro->pivot->contribution_hours }}"
                                            min="0"
                                            max="10000"
                                            step="0.01"
                                            required
                                            class="w-full border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                    </div>

                                    <div class="flex flex-wrap gap-2">
                                        <button
                                            type="submit"
                                            class="bg-indigo-600 text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition"
                                        >
                                            Guardar cambios
                                        </button>

                                        <button
                                            type="button"
                                            @click="editing = false"
                                            class="border border-gray-300 bg-white text-gray-700 px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-100 transition"
                                        >
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endcan
                </tbody>
            @empty
                <tbody>
                    <tr>
                        @can('update', $project)
                            <td colspan="4" class="px-6 py-12 text-center">
                        @else
                            <td colspan="3" class="px-6 py-12 text-center">
                        @endcan
                            <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>

                            <p class="font-semibold text-gray-700">
                                Todavía no hay participantes
                            </p>

                            <p class="text-sm text-gray-500 mt-2">
                                @can('update', $project)
                                    Añade participantes para empezar a colaborar en este proyecto.
                                @else
                                    Este proyecto todavía no tiene participantes.
                                @endcan
                            </p>
                        </td>
                    </tr>
                </tbody>
            @endforelse
        </table>
    </div>
</div>