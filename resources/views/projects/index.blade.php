<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Mis proyectos
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Organiza tus proyectos y consulta tus colaboraciones.
                </p>
            </div>

            <a href="{{ route('projects.create') }}"
               class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition text-center font-medium">
                + Nuevo proyecto
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-8">

        <section class="mb-10">

            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        Creados por mí
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Proyectos de los que eres propietario.
                    </p>
                </div>

                <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ $propios->count() }}
                </span>
            </div>

            @if ($propios->isEmpty())

                <div class="bg-white border border-dashed border-gray-300 rounded-xl p-8 text-center">
                    <h4 class="font-semibold text-gray-700">
                        Todavía no has creado ningún proyecto
                    </h4>

                    <p class="text-sm text-gray-500 mt-2 mb-5">
                        Crea tu primer proyecto y empieza a organizar el trabajo.
                    </p>

                    <a href="{{ route('projects.create') }}"
                       class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Crear mi primer proyecto
                    </a>
                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($propios as $proyecto)
                        <x-project-card :project="$proyecto" />
                    @endforeach
                </div>

            @endif

        </section>

        <section>

            <div class="flex justify-between items-center mb-5">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        Proyectos en los que participo
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Proyectos en los que colaboras con otros usuarios.
                    </p>
                </div>

                <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ $participando->count() }}
                </span>
            </div>

            @if ($participando->isEmpty())

                <div class="bg-white border border-dashed border-gray-300 rounded-xl p-8 text-center">
                    <h4 class="font-semibold text-gray-700">
                        Todavía no participas en otros proyectos
                    </h4>

                    <p class="text-sm text-gray-500 mt-2">
                        Cuando te añadan como participante, tus proyectos aparecerán aquí.
                    </p>
                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($participando as $proyecto)
                        <x-project-card :project="$proyecto" :role="$proyecto->pivot->role" />
                    @endforeach
                </div>

            @endif

        </section>

    </div>

</x-app-layout>
