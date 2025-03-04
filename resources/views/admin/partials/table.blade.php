<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach ($headers as $header)
                    <th scope="col" class="px-6 py-3">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $index => $item)
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 {{ !$loop->last ? 'border-b dark:border-gray-700 border-gray-200' : '' }}">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ ($items->currentPage() - 1) * $items->perPage() + $index + 1 }}
                    </th>
                    @foreach ($columns as $column)
                        <td class="px-6 py-4">
                            @php
                                $attributes = explode('->', $column);
                                $value = $item;
                                foreach ($attributes as $attribute) {
                                    $value = $value->{$attribute} ?? null;
                                    if (!$value) break;
                                }
                            @endphp

                            @if ($value)
                                {{ $value }} <!-- Si el valor está disponible, mostrarlo -->
                            @else
                                <span class="text-red-500">No disponible</span> <!-- O personalizar el mensaje -->
                            @endif
                        </td>
                    @endforeach
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-between">
                            <a href="{{ route($editRoute, $item) }}"
                                class="font-medium text-blue-600 dark:text-blue-500">
                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                            </a>
                            <form action="{{ route($deleteRoute, $item) }}" method="POST"
                                id="delete-form-{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="font-medium text-red-600 dark:text-red-500"
                                    onclick="confirmDelte({{ $item->id }})">
                                    <i class="fa-solid fa-trash-can fa-lg"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('admin.partials.sweet-alert-destroy')