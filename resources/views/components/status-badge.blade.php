@props(['status'])

@if ($status === 'pendiente')
    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs inline-block whitespace-nowrap">
        Pendiente
    </span>
@elseif ($status === 'en progreso')
    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs inline-block whitespace-nowrap">
        En progreso
    </span>
@elseif ($status === 'finalizado')
    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs inline-block whitespace-nowrap">
        Finalizado
    </span>
@else
    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs inline-block whitespace-nowrap">
        {{ ucfirst($status) }}
    </span>
@endif
