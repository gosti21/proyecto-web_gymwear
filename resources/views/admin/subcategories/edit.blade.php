<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'SubCategorías',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => 'Editar - ' . $data->name,
        
    ],
]">

    @livewire('admin.subcategories.subcategory-edit', compact('data'))

    @push('js')
        <script>
            Livewire.on('subcategoryUpdated', newName => {
                document.getElementById('breadcrumb-edit').innerText = 'Editar - ' + newName;
            });
        </script>
    @endpush

</x-admin-layout>