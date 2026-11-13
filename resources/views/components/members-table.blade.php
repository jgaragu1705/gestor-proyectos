
@props(['project'])

<div class="bg-white rounded-xl shadow overflow-x-auto mb-8">

    <table class="w-full text-left">

        <thead class="bg-gray-100 text-sm text-gray-600 uppercase">
            <tr>
                <th class="p-4">Nombre</th>
                <th class="p-4">Rol</th>
                <th class="p-4">Horas de contribución</th>
                <th class="p-4">Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($project->members as $miembro)

                <tr class="border-t">

                    <td class="p-4">
                        {{ $miembro->name }}
                    </td>

                    <td class="p-4">
                        {{ $miembro->pivot->role }}
                    </td>

                    <td class="p-4">
                        {{ $miembro->pivot->contribution_hours }}
                    </td>

                    <td class="p-4">

                        @can('update', $project)

                            <form method="POST" action="{{ route('projects.members.update', [$project, $miembro]) }}" class="flex flex-wrap gap-2 mb-2">
                                @csrf
                                @method('PATCH')

                                <select name="role" required class="border-gray-300 rounded-lg text-sm">

                                    @foreach (\App\Models\Project::ROLES as $rol)
                                        <option value="{{ $rol }}" {{ $miembro->pivot->role == $rol ? 'selected' : '' }}>
                                            {{ $rol }}
                                        </option>
                                    @endforeach

                                </select>

                                <input type="number" name="contribution_hours" value="{{ $miembro->pivot->contribution_hours }}" min="0" step="0.01" required class="border-gray-300 rounded-lg text-sm w-24">

                                <button type="submit" class="bg-indigo-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-indigo-700">
                                    Modificar
                                </button>
                            </form>

                            <form method="POST" action="{{ route('projects.members.destroy', [$project, $miembro]) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('¿Seguro que quieres eliminarlo?')" class="text-red-600 hover:text-red-800 text-sm">
                                    Eliminar participante
                                </button>
                            </form>

                        @endcan

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4" class="p-4 text-gray-500 text-center">
                        Este proyecto todavía no tiene miembros.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>
