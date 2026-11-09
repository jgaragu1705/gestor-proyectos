@props(['status'])

@if ($status == 'pendiente')
    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs inline-block mt-3">
        Pendiente
    </span>
@elseif ($status == 'en progreso')
    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs inline-block mt-3">
        En progreso
    </span>
@elseif ($status == 'finalizado')
    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs inline-block mt-3">
        Finalizado
    </span>
@else
    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs inline-block mt-3">
        {{ ucfirst($status) }}
    </span>
@endif