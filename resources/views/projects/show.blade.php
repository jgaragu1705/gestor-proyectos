
<x-app-layout>

    <h2>Detalle del proyecto</h2>

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
        </tr>

        @forelse ($project->members as $miembro)

            <tr>
                <td>{{ $miembro->name }}</td>
                <td>{{ $miembro->pivot->role }}</td>
                <td>{{ $miembro->pivot->contribution_hours }}</td>
            </tr>

        @empty

            <tr>
                <td colspan="3">Este proyecto todavía no tiene miembros.</td>
            </tr>

        @endforelse

    </table>


    @can('update', $project)
        <h3>Añadir participante</h3>

        <form method="POST" action="{{ route('projects.members.store', $project) }}">
            @csrf

            <label>ID del usuario:</label>
            <input type="number" name="user_id" required>

            <label>Rol:</label>
            <input type="text" name="role" required>

            <label>Horas de contribución:</label>
            <input type="number" name="contribution_hours" min="0" step="0.01">

            <button type="submit">Añadir participante</button>
        </form>
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
