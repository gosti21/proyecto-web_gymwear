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

    @if ($subCategories->count())

        @include('admin.partials.table', [
            'headers' => ['#', 'Nombre', 'Categoria', 'Familia', 'Acciones'],
            'columns' => ['name', 'category->name', 'category->family->name'], 
            'items' => $subCategories, 
            'editRoute' => 'admin.subcategories.edit',
            'deleteRoute' => 'admin.subcategories.destroy'
        ])

        @if($subCategories->lastPage() > 1)
            <div class="mt-4">
                {{ $subCategories->links() }}
            </div>
        @endif

    @else

        @include('admin.partials.alert-info', ['message' => 'Todavía no hay subcategorías registradas.'])
    
    @endif

</x-admin-layout>
