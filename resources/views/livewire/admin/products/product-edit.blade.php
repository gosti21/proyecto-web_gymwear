<div class="card card-color">
    <form>
        
        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Familias
            </x-label>

            <x-select wire:model.live="family_id" wire:key="family-select-{{ $family_id }}">
                <option disabled value="">Selecciona una familia </option>
                @foreach ($families as $family)
                    <option value="{{ $family->id }}">
                        {{ $family->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
        
        <div class="mb-4">
            <x-label class="mb-2">
                Categorías
            </x-label>

            <x-select wire:model.live="category_id" wire:key="category-select-{{ $family_id }}-{{ $category_id }}">
                <option disabled value="">Selecciona una categoría </option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
        
        <div class="mb-4">
            <x-label class="mb-2">
                SubCategorías
            </x-label>
            
            <x-select wire:model.live="sub_category_id" wire:key="subcategory-select-{{ $family_id }}-{{ $category_id }}-{{ $sub_category_id }}">
                <option disabled value="">Selecciona una subcategoría </option>
                @foreach ($this->subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">
                        {{ $subcategory->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
    
        <div class="mb-4">
            <x-label class="mb-2">
                Nombre
            </x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre del producto" wire:model="name" wire:key="name"/>
        </div>
        
        <div class="mb-4">
            <x-label class="mb-2">
                Precio
            </x-label>
            <x-input class="w-full" placeholder="Ingrese el precio del producto" wire:model="price"  wire:key="price"
                type="number" step="0.01"/>
        </div>
    
        <div class="mb-4">
            <x-label class="mb-2">
                Descripción
            </x-label>
            <x-textarea wire:model="description" placeholder="Ingrese una descripción para el producto" rows="4">
            </x-textarea>
        </div>
    
        <h6 class="mb-2 block font-medium text-gray-700 dark:text-gray-300">
            Imagen
        </h6>
        <div class="flex justify-center relative mt-4">
            <div class="absolute top-8 right-8">
                <label class="flex items-center btn2 btn-light cursor-pointer">
                    <i class="fa-solid fa-images fa-lg mr-2"></i>
                    Subir imagen
    
                    <input type="file" class="hidden" wire:model="image" accept="image/*">
                </label>
            </div>
            <figure class="max-w-lg">
                <img class="h-auto max-w-full" 
                src="{{ $image ? $image->temporaryUrl() : Storage::url($path) }}" alt="">
            </figure>
        </div>

        <div class="flex justify-end">
            <x-button type="button" onclick="confirmEdit()">
                Actualizar
            </x-button>
        </div>
    </form>

    @push('js')
        <script>
            function confirmEdit() {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, actualizar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('save');
                    }
                });
            }
        </script>
    @endpush
</div>
