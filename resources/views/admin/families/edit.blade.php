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
        <form action="{{ route('admin.families.update', $family) }}" method="POST" id="edit-form">
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