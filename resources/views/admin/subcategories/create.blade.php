<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'SubCategorias',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => 'Crear',
    ],
]">
    {{-- <div class="card card-color">
        <form action="{{ route('admin.subcategories.store') }}" method="POST">
            @csrf

            <x-validation-errors class="mb-4"/>

            <div class="mb-4">
                <x-label class="mb-2">
                    Categoría
                </x-label>

                <x-select name="category_id">
                    <option disabled selected>Selecciona una opción: </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" 
                    placeholder="Ingrese el nombre de la subcategoría" 
                    name="name" value="{{ old('name') }}"/>
            </div>

            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </form>
    </div> --}}

    @livewire('admin.subcategories.subcategory-create')
</x-admin-layout>