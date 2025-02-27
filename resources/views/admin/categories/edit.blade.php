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
        'name' => 'Editar - ' . $category->name,
    ],
]">
    <div class="card card-color">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PATCH')

            <x-validation-errors class="mb-4"/>

            <div class="mb-4">
                <x-label class="mb-2">
                    Familia
                </x-label>

                <x-select name="family_id">
                    <option disabled selected>Selecciona una opción: </option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}"
                            @selected(old('family_id', $category->family_id) == $family->id)>
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" 
                    placeholder="Ingrese el nombre de la categoría" 
                    name="name" value="{{ old('name', $category->name) }}"/>
            </div>

            <div class="flex justify-end">
                <x-button>
                    Actualizar
                </x-button>
            </div>
        </form>
    </div>
</x-admin-layout>