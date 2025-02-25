<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => 'Editar - ' . $family->name,
    ],
]">

    <div class="card card-color">
        <form action="{{ route('admin.families.update', $family) }}" method="POST">
            @csrf

            @method('PUT')

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" 
                    placeholder="Ingrese el nombre de la familia" 
                    name="name" value="{{ old('name', $family->name) }}"/>
            </div>
            <div class="flex justify-end">
                <x-button>
                    Actualizar
                </x-button>
            </div>
        </form>
    </div>
    
</x-admin-layout>