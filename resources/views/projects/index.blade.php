<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                Proyectos
            </h2>

            <a href="{{ route('projects.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Nuevo proyecto
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-8">

        <h3 class="text-lg font-semibold mb-4">Creados por mí</h3>

        @if ($propios->isEmpty())

            <p class="text-gray-500 mb-8">
                Todavía no tienes proyectos.
            </p>

        @else

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">

                @foreach ($propios as $proyecto)

                    <x-project-card :project="$proyecto" />

                @endforeach

            </div>

        @endif

        <h3 class="text-lg font-semibold mb-4">Proyectos en los que participo</h3>

        @if ($participando->isEmpty())

            <p class="text-gray-500">
                No participas en ningún proyecto.
            </p>

        @else

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($participando as $proyecto)

                    <x-project-card :project="$proyecto" :role="$proyecto->pivot->role" />

                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>