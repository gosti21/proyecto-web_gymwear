<x-container>
    <div class="card card-color">
        <div class="grid md:grid-cols-2 gap-6 items-center">
            <div class="col-span-1">
                <figure>
                    <img src="{{ Storage::url($product->images->first()->path) }}"
                        class="aspect-[16/9] w-full object-cover object-center" alt="product-{{ $product->name }}">
                </figure>
            </div>
            <div class="col-span-1">
                <h1 class="text-xl text-gray-900 dark:text-white font-semibold mb-2">
                    {{ $product->name }}
                </h1>

                <div class="flex space-x-2 items-center mb-4">
                    <ul class="flex space-x-2">
                        <li>
                            <i class="fa-solid fa-star text-yellow-400 fa-sm"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-400 fa-sm"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-400 fa-sm"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-400 fa-sm"></i>
                        </li>
                        <li>
                            <i class="fa-solid fa-star text-yellow-400 fa-sm"></i>
                        </li>
                    </ul>
                    <p class="text-sm text-gray-700 dark:text-gray-300">4.7 (55)</p>
                </div>

                <p class="font-semibold text-2xl mb-4 text-gray-600 dark:text-gray-200">
                    S/. {{ $product->price }}
                </p>

                <div class="flex space-x-6 items-center mb-6"
                    x-data="{
                        qty: @entangle('qty')
                    }">
                    <button class="btn3 btn-light disabled:cursor-not-allowed"
                        x-on:click="qty -= 1"
                        x-bind:disabled="qty == 1">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                    <span class="text-gray-700 dark:text-gray-300 inline-block w-8 text-center"
                        x-text="qty">
                    </span>
                    <button class="btn3 btn-light"
                        x-on:click="qty += 1">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <button class="btn btn-blue w-full mb-7"
                    wire:click="addToCart" wire:loading.attr="disabled">
                    Agregar al carrito
                </button>

                <div class="mb-6">
                    <p class="font-medium text-gray-900 dark:text-white">Descripción:</p>
                    <p class="text-gray-700 dark:text-gray-300">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="flex items-center space-x-4 text-gray-800 dark:text-gray-200">
                    <i class="fa-solid fa-truck-fast fa-xl"></i>
                    <p>Despacho a domicilio</p>
                </div>
            </div>
        </div>
    </div>
</x-container>
