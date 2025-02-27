<div class="card card-color">
    <form>

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Familias
            </x-label>

            <x-select wire:model="subCategory.family_id">
                <option disabled selected value="">Selecciona una opción: </option>
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

            <x-select name="category_id">
                <option disabled selected value="">Selecciona una opción: </option>
                @foreach ($this->categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Nombre
            </x-label>
            <x-input class="w-full" placeholder="Ingrese el nombre de la subcategoría"/>
        </div>

        <div class="flex justify-end">
            <x-button>
                Guardar
            </x-button>
        </div>
    </form>
</div>
