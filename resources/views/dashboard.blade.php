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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

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

            <x-card>
                <p class="text-sm text-gray-500 mb-2">
                    Horas aportadas como participante
                </p>

                <p class="text-4xl font-bold text-indigo-600">
                    {{ number_format($horasAportadas, 2, ',', '.') }}
                </p>
            </x-card>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            <x-card>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    Próximos vencimientos
                </h3>

                @forelse ($proximosVencimientos as $proyecto)
                    <div class="py-3 border-b border-gray-100 last:border-0">
                        <div class="flex justify-between items-center gap-3">
                            <a href="{{ route('projects.show', $proyecto) }}"
                               class="font-medium text-gray-800 hover:text-indigo-600">
                                {{ $proyecto->title }}
                            </a>

                            <span class="text-sm text-gray-500 whitespace-nowrap">
                                {{ $proyecto->deadline->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">
                        No tienes próximos vencimientos.
                    </p>
                @endforelse
            </x-card>

            <x-card>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    Proyectos recientes
                </h3>

                @forelse ($proyectosRecientes as $proyecto)
                    <div class="py-3 border-b border-gray-100 last:border-0">
                        <a href="{{ route('projects.show', $proyecto) }}"
                           class="font-medium text-gray-800 hover:text-indigo-600">
                            {{ $proyecto->title }}
                        </a>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $proyecto->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">
                        Todavía no tienes proyectos. ¡Crea el primero!
                    </p>
                @endforelse
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
