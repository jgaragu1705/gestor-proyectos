<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Panel de control
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800">
                ¡Bienvenido, {{ Auth::user()->name }}!
            </h3>

            <p class="text-gray-500 mt-2">
                Aquí puedes consultar un resumen de tu actividad en los proyectos.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <x-card>
                <p class="text-sm text-gray-500 mb-2">
                    Proyectos creados
                </p>

                <p class="text-4xl font-bold text-indigo-600">
                    {{ $proyectosCreados }}
                </p>
            </x-card>

            <x-card>
                <p class="text-sm text-gray-500 mb-2">
                    Proyectos en los que participas
                </p>

                <p class="text-4xl font-bold text-indigo-600">
                    {{ $proyectosParticipando }}
                </p>
            </x-card>

        </div>

        <x-card>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                Gestiona tus proyectos
            </h3>

            <p class="text-sm text-gray-500 mb-4">
                Accede a tus proyectos, consulta sus detalles y gestiona los participantes.
            </p>

            <a href="{{ route('projects.index') }}"
               class="inline-block bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">
                Ir a mis proyectos
            </a>
        </x-card>

    </div>

</x-app-layout>
