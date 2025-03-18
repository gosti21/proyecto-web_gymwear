<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => $subcategory->name,
    ],
]">

    @livewire('admin.subcategories.subcategory-edit', compact('subcategory'))

</x-admin-layout>
