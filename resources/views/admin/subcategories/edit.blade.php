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
        'name' => 'Editar - ' . $subcategory->name,
        
    ],
]">

    @livewire('admin.subcategories.subcategory-edit', compact('subcategory'))

    @push('js')
        <script>
        Livewire.on('subcategoryUpdated', newName => {
            document.getElementById('breadcrumb-edit').innerText = 'Editar - ' + newName;
        });
    </script>
    @endpush
</x-admin-layout>