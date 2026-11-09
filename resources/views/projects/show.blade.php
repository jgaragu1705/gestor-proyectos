<x-app-layout>

    <h2>Detalle del proyecto</h2>

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h3>{{ $project->title }}</h3>

    <p>Descripción: {{ $project->description }}</p>

    <p>Fecha límite: {{ $project->deadline->format('d/m/Y') }}</p>

    <p>Estado: {{ $project->status }}</p>

    <p>Propietario: {{ $project->owner->name }}</p>


    <h3>Miembros del proyecto</h3>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Horas de contribución</th>
            <th>Acciones</th>
        </tr>

        @forelse ($project->members as $miembro)

            <tr>
                <td>{{ $miembro->name }}</td>
                <td>{{ $miembro->pivot->role }}</td>
                <td>{{ $miembro->pivot->contribution_hours }}</td>

                <td>
                    @can('update', $project)

                        <form method="POST" action="{{ route('projects.members.update', [$project, $miembro]) }}">
                            @csrf
                            @method('PATCH')

                            <select name="role" required>
                                <option value="Desarrollador" {{ $miembro->pivot->role == 'Desarrollador' ? 'selected' : '' }}>Desarrollador</option>
                                <option value="Diseñador" {{ $miembro->pivot->role == 'Diseñador' ? 'selected' : '' }}>Diseñador</option>
                                <option value="Tester" {{ $miembro->pivot->role == 'Tester' ? 'selected' : '' }}>Tester</option>
                            </select>

                            <input type="number" name="contribution_hours" value="{{ $miembro->pivot->contribution_hours }}" min="0" step="0.01" required>

                            <button type="submit">Modificar</button>
                        </form>

                        <form method="POST" action="{{ route('projects.members.destroy', [$project, $miembro]) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit">Eliminar participante</button>
                        </form>

                    @endcan
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="4">Este proyecto todavía no tiene miembros.</td>
            </tr>

        @endforelse

    </table>


    @can('update', $project)

        <h3>Añadir participante</h3>

        @if ($usuariosDisponibles->isNotEmpty())

            <form method="POST" action="{{ route('projects.members.store', $project) }}">
                @csrf

                <label>Usuario:</label>
                <select name="user_id" required>
                    @foreach ($usuariosDisponibles as $usuario)
                        <option value="{{ $usuario->id }}">
                            {{ $usuario->name }}
                        </option>
                    @endforeach
                </select>

                <label>Rol:</label>
                <select name="role" required>
                    <option value="Desarrollador">Desarrollador</option>
                    <option value="Diseñador">Diseñador</option>
                    <option value="Tester">Tester</option>
                </select>

                <label>Horas de contribución:</label>
                <input type="number" name="contribution_hours" min="0" step="0.01">

                <button type="submit">Añadir participante</button>
            </form>

        @else

            <p>No hay usuarios disponibles para añadir.</p>

        @endif

    @endcan


    @can('update', $project)
        <p>
            <a href="{{ route('projects.edit', $project) }}">Editar proyecto</a>
        </p>
    @endcan

    @can('delete', $project)
        <form method="POST" action="{{ route('projects.destroy', $project) }}">

            @csrf
            @method('DELETE')

            <button type="submit">Eliminar proyecto</button>

        </form>
    @endcan


    <p>
        <a href="{{ route('projects.index') }}">Volver al listado</a>
    </p>

</x-app-layout>
