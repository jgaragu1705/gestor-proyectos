<x-app-layout>

    <h2>Editar proyecto</h2>

    <form method="POST" action="{{ route('projects.update', $project) }}">

        @csrf
        @method('PUT')

        <p>
            <label for="title">Título:</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $project->title) }}"
            >

            @error('title')
                <span>{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="description">Descripción:</label>
            <textarea
                id="description"
                name="description"
            >{{ old('description', $project->description) }}</textarea>

            @error('description')
                <span>{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="deadline">Fecha límite:</label>
            <input
                type="date"
                id="deadline"
                name="deadline"
                value="{{ old('deadline', $project->deadline->format('Y-m-d')) }}"
            >

            @error('deadline')
                <span>{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="status">Estado:</label>

            <select id="status" name="status">

                <option value="pendiente" {{ old('status', $project->status) == 'pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="en progreso" {{ old('status', $project->status) == 'en progreso' ? 'selected' : '' }}>
                    En progreso
                </option>

                <option value="finalizado" {{ old('status', $project->status) == 'finalizado' ? 'selected' : '' }}>
                    Finalizado
                </option>

            </select>

            @error('status')
                <span>{{ $message }}</span>
            @enderror
        </p>

        <button type="submit">
            Guardar cambios
        </button>

    </form>

    <p>
        <a href="{{ route('projects.show', $project) }}">Volver al proyecto</a>
    </p>

</x-app-layout>