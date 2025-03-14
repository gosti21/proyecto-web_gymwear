<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index'),
    ],
    [
        'name' => $product->name,
        'route' => route('admin.products.show', $product->id),
    ],
    [
        'name' => 'variante - ' . $variant->features->pluck('description')->implode(' | '),
    ],
]">

    <form action="" method="POST">
        @csrf
        <h6 class="mb-2 block font-medium text-gray-700 dark:text-gray-300">
            Imagen
        </h6>
        <div class="flex justify-center relative mt-4">
            <div class="absolute top-0 right-8">
                <label class="flex items-center btn2 btn-light cursor-pointer">
                    <i class="fa-solid fa-images fa-lg mr-2"></i>
                        Subir imagen
                    <input type="file" class="hidden" accept="image/*" name="image"
                    onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>
            <figure class="max-w-lg">
                <img class="h-auto max-w-full" 
                    src="{{ $variant->images->isEmpty() ? asset('assets/img/no-image-2.jpg') : Storage::url($variant->images->first()->path) }}" 
                    alt="" id="imgPreview">
            </figure>
        </div>
    </form>

    @push('js')
        <script>
            function previewImage(event, querySelector){
	            //Recuperamos el input que desencadeno la acción
	            const input = event.target;
	
	            //Recuperamos la etiqueta img donde cargaremos la imagen
	            $imgPreview = document.querySelector(querySelector);

	            // Verificamos si existe una imagen seleccionada
	            if(!input.files.length) return
	
	            //Recuperamos el archivo subido
	            file = input.files[0];

	            //Creamos la url
	            objectURL = URL.createObjectURL(file);
	
	            //Modificamos el atributo src de la etiqueta img
	            $imgPreview.src = objectURL;
                
            }
        </script>
    @endpush
</x-admin-layout>