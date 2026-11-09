
<x-app-layout>

    <h2>Nuevo proyecto</h2>

    <form method="POST" action="{{ route('projects.store') }}">

        @csrf

        <p>
            <label for="title">Título:</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
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
            >{{ old('description') }}</textarea>

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
                value="{{ old('deadline') }}"
            >

            @error('deadline')
                <span>{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="status">Estado:</label>

            <select id="status" name="status">

                <option value="pendiente" {{ old('status') == 'pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="en progreso" {{ old('status') == 'en progreso' ? 'selected' : '' }}>
                    En progreso
                </option>

                <option value="finalizado" {{ old('status') == 'finalizado' ? 'selected' : '' }}>
                    Finalizado
                </option>

            </select>

            @error('status')
                <span>{{ $message }}</span>
            @enderror
        </p>

        <button type="submit">
            Guardar proyecto
        </button>

    </form>

</x-app-layout>
