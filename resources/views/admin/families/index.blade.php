<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
    ],
]">

    <x-slot name="action">
        @include('admin.partials.create-button', ['route' => route('admin.families.create')])
    </x-slot>
    
    @if ($families->count())
        
        @include('admin.partials.table', [
            'headers' => ['#', 'Nombre', 'Acciones'],
            'columns' => ['name'], 
            'items' => $families, 
            'editRoute' => 'admin.families.edit',
            'deleteRoute' => 'admin.families.destroy'
        ])

        @if($families->lastPage() > 1)
            <div class="mt-4">
                {{ $families->links() }}
            </div>
        @endif
        
    @else

        @include('admin.partials.alert-info', ['message' => 'Todavía no hay familias de productos registrados.'])

    @endif

</x-admin-layout>
