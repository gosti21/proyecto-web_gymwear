<x-app-layout>
    <x-container class="px-4 my-4">
        <div>
            @include('shop.partials.breadcrumb', [
                'breadcrumbs' => [
                    [
                        'name' => $product->subcategory->category->family->name,
                        'route' => route('families.show', $product->subcategory->category->family)
                    ],
                    [
                        'name' => $product->subcategory->category->name,
                        'route' => route('categories.show', $product->subcategory->category)
                    ],
                    [
                        'name' => $product->subcategory->name,
                        'route' => route('subcategories.show', $product->subcategory)
                    ]
                ]
            ])
        </div>
    </x-container>

    @if ($product->variants->count())
        @livewire('shop.products.add-to-cart-variants', ['product' => $product])
    @else
        @livewire('shop.products.add-to-cart', ['product' => $product])
    @endif
</x-app-layout>