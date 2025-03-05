<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
    ],
]">

    <x-slot name="action">
        @include('admin.partials.create-button', ['route' => route('admin.categories.create')])
    </x-slot>

    @if ($data->count())

        @include('admin.partials.table', [
            'headers' => ['#', 'Nombre', 'Familia', 'Acciones'],
            'columns' => ['name', 'family->name'], 
            'items' => $data, 
            'editRoute' => 'admin.categories.edit',
            'deleteRoute' => 'admin.categories.destroy'
        ])

        @if($data->lastPage() > 1)
            <div class="mt-4">
                {{ $data->links() }}
            </div>
        @endif

    @else

        @include('admin.partials.alert-info', ['message' => 'Todavía no hay categorías registradas.'])

    @endif

</x-admin-layout>
