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

    @if ($categories->count())

        @include('admin.partials.table', [
            'headers' => ['#', 'Nombre', 'Familia', 'Acciones'],
            'columns' => ['name', 'family->name'], 
            'items' => $categories, 
            'editRoute' => 'admin.categories.edit',
            'deleteRoute' => 'admin.categories.destroy'
        ])

        @if($categories->lastPage() > 1)
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        @endif

    @else

        @include('admin.partials.alert-info', ['message' => 'Todavía no hay categorías registradas.'])

    @endif

</x-admin-layout>
