
<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar proyecto
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 py-8">

        <x-card>

            <form method="POST" action="{{ route('projects.update', $project) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm text-gray-600 mb-1">
                        Nombre del proyecto
                    </label>

                    <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" class="w-full border-gray-300 rounded-lg text-sm">

                    @error('title')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm text-gray-600 mb-1">
                        Descripción
                    </label>

                    <textarea id="description" name="description" rows="4" class="w-full border-gray-300 rounded-lg text-sm">{{ old('description', $project->description) }}</textarea>

                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deadline" class="block text-sm text-gray-600 mb-1">
                        Fecha límite
                    </label>

                    <input type="date" id="deadline" name="deadline" value="{{ old('deadline', $project->deadline->format('Y-m-d')) }}" class="w-full border-gray-300 rounded-lg text-sm">

                    @error('deadline')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm text-gray-600 mb-1">
                        Estado
                    </label>

                    <select id="status" name="status" class="w-full border-gray-300 rounded-lg text-sm">

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
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">

                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                        Guardar cambios
                    </button>

                    <a href="{{ route('projects.show', $project) }}" class="text-gray-600 hover:text-gray-800">
                        Cancelar
                    </a>

                </div>

            </form>

        </x-card>

    </div>

</x-app-layout>
