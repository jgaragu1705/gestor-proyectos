
<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Detalle del proyecto
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-8">

        @if (session('error'))
            <p class="bg-red-100 text-red-800 p-3 rounded-lg mb-4">
                {{ session('error') }}
            </p>
        @endif

        @if (session('success'))
            <p class="bg-green-100 text-green-800 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </p>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded-lg mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <x-card class="mb-6">

            <h3 class="text-2xl font-bold mb-2">
                {{ $project->title }}
            </h3>

            <p class="text-sm text-gray-500">
                Descripción: {{ $project->description }}
            </p>

            <p class="text-sm text-gray-500 mt-2">
                Fecha límite: {{ $project->deadline->format('d/m/Y') }}
            </p>

            <p class="text-sm text-gray-500 mt-2">
                Propietario: {{ $project->owner->name }}
            </p>

            <x-status-badge :status="$project->status" />

        </x-card>

        <h3 class="text-lg font-semibold mb-4">
            Miembros del proyecto
        </h3>

        <x-members-table :project="$project" />

        @can('update', $project)

            <x-card class="mb-8">

                <h3 class="text-lg font-semibold mb-4">
                    Añadir participante
                </h3>

                @if ($usuariosDisponibles->isNotEmpty())

                    <form method="POST" action="{{ route('projects.members.store', $project) }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        @csrf

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">
                                Usuario
                            </label>

                            <select name="user_id" required class="w-full border-gray-300 rounded-lg text-sm">
                                @foreach ($usuariosDisponibles as $usuario)
                                    <option value="{{ $usuario->id }}">
                                        {{ $usuario->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">
                                Rol
                            </label>

                            <select name="role" required class="w-full border-gray-300 rounded-lg text-sm">
                                @foreach (\App\Models\Project::ROLES as $rol)
                                    <option value="{{ $rol }}">
                                        {{ $rol }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">
                                Horas de contribución
                            </label>

                            <input type="number" name="contribution_hours" min="0" step="0.01" class="w-full border-gray-300 rounded-lg text-sm">
                        </div>

                        <div>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 w-full">
                                Añadir participante
                            </button>
                        </div>

                    </form>

                @else

                    <p class="text-sm text-gray-500">
                        No hay usuarios disponibles para añadir.
                    </p>

                @endif

            </x-card>

        @endcan

        <div class="flex items-center gap-3 flex-wrap">

            @can('update', $project)
                <a href="{{ route('projects.edit', $project) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                    Editar proyecto
                </a>
            @endcan

            @can('delete', $project)
                <form method="POST" action="{{ route('projects.destroy', $project) }}" class="inline" onsubmit="return confirm('¿Seguro que quieres eliminar este proyecto?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Eliminar proyecto
                    </button>
                </form>
            @endcan

            <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-800">
                Volver al listado
            </a>

        </div>

    </div>

</x-app-layout>
