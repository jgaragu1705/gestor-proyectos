<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar proyecto
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Modifica la información y actualiza los datos del proyecto.
        </p>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 py-8">
        <x-card>
            <form method="POST" action="{{ route('projects.update', $project) }}">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nombre del proyecto
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $project->title) }}"
                        maxlength="255"
                        required
                        class="w-full border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >

                    @error('title')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Descripción
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('description', $project->description) }}</textarea>

                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-2">
                            Fecha límite
                        </label>

                        <input
                            type="date"
                            id="deadline"
                            name="deadline"
                            value="{{ old('deadline', $project->deadline->format('Y-m-d')) }}"
                            required
                            class="w-full border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        @error('deadline')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            Estado
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="w-full border-gray-300 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            @foreach (\App\Models\Project::STATUSES as $estado)
                                <option value="{{ $estado }}" {{ old('status', $project->status) === $estado ? 'selected' : '' }}>
                                    {{ ucfirst($estado) }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-5 border-t border-gray-100">
                    <a
                        href="{{ route('projects.show', $project) }}"
                        class="text-center px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium"
                    >
                        Guardar cambios
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
