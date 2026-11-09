<x-app-layout>

    <h2>Mis proyectos</h2>

    <p>
        <a href="{{ route('projects.create') }}">Crear nuevo proyecto</a>
    </p>

    @forelse ($propios as $proyecto)

        <div>
            <h3>{{ $proyecto->title }}</h3>

            <p>Descripción: {{ $proyecto->description }}</p>
            <p>Fecha límite: {{ $proyecto->deadline->format('d/m/Y') }}</p>
            <p>Estado: {{ $proyecto->status }}</p>

            <a href="{{ route('projects.show', $proyecto) }}">Ver detalles</a>
        </div>

    @empty

        <p>Todavía no tienes proyectos.</p>

    @endforelse


    <h2>Proyectos en los que participo</h2>

    @forelse ($participando as $proyecto)

        <div>
            <h3>{{ $proyecto->title }}</h3>

            <p>Descripción: {{ $proyecto->description }}</p>
            <p>Fecha límite: {{ $proyecto->deadline->format('d/m/Y') }}</p>
            <p>Estado: {{ $proyecto->status }}</p>
            <p>Mi rol: {{ $proyecto->pivot->role }}</p>

            <a href="{{ route('projects.show', $proyecto) }}">Ver detalles</a>
        </div>

    @empty

        <p>No participas en ningún proyecto.</p>

    @endforelse

</x-app-layout>