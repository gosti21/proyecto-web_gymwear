<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'SubCategorías',
    ],
]">

    <x-slot name="action">
        @include('admin.partials.create-button', ['route' => route('admin.subcategories.create')])
    </x-slot>

    @if ($data->count())

        @include('admin.partials.table', [
            'headers' => ['#', 'Nombre', 'Categoria', 'Familia', 'Acciones'],
            'columns' => ['name', 'category->name', 'category->family->name'], 
            'items' => $data, 
            'editRoute' => 'admin.subcategories.edit',
            'deleteRoute' => 'admin.subcategories.destroy'
        ])

        @if($data->lastPage() > 1)
            <div class="mt-4">
                {{ $data->links() }}
            </div>
        @endif

    @else

        @include('admin.partials.alert-info', ['message' => 'Todavía no hay subcategorías registradas.'])
    
    @endif

</x-admin-layout>
