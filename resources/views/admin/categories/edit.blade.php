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
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" id="edit-form">
            @csrf
            @method('PATCH')

            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">
                    Familia
                </x-label>

                <x-select name="family_id">
                    <option disabled selected>Selecciona una familia </option>
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
                <x-button type="button" onclick="confirmEdit()">
                    Actualizar
                </x-button>
            </div>
        </form>
    </div>
    
    @push('js')
        <script>
            function confirmEdit(){
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('edit-form').submit();
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>