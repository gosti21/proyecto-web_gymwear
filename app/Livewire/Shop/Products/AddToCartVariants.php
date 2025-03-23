<?php

namespace App\Livewire\Shop\Products;

use App\Models\Feature;
use App\Models\Variant;
use App\Traits\Admin\sweetAlerts;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddToCartVariants extends Component
{
    use sweetAlerts;

    public $product;

    public $qty = 1;

    public $variants;
    public $availableOptions;
    public $selectedFeatures = [];

    public function mount()
    {
        $this->variants = Variant::where('product_id', $this->product->id)
            ->with('features.option')
        ->get();

        $groupedOptions = $this->variants->flatMap(fn($variant) => $variant->features)
            ->groupBy(fn($feature) => $feature->option->id)
            ->map(fn($group) => $group->sortBy(fn($feature) => $feature->option->order));

        $this->availableOptions = $groupedOptions;

        foreach ($groupedOptions as $optionId  => $features) {
            $firstFeature = $features->first();
            $this->selectedFeatures[$firstFeature['option_id']] = $firstFeature['id'];
        }
    }
    
    #[Computed()]
    public function variantImg()
    {
        return $this->product->variants->filter(function($variant){
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);
        })->first();
    }

    public function addToCart()
    {
        Cart::instance('shopping');

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->variantImg->images->first()->path,
                'sku' => $this->variantImg->sku,
                'features' => Feature::whereIn('id', $this->selectedFeatures)->pluck('description', 'id')->toArray()
            ]
        ]);

        if (Auth::check()) {
            Cart::store(Auth::user()->id);
        }

        $this->dispatch('cartUpdated', Cart::count());

        $this->alertGenerate2([
            'title' => '¡Producto añadido a tu carrito!',
            'text' => "¡Todo listo! El producto ya está en tu carrito de compras.",
        ]);
    }

    public function render()
    {
        return view('livewire.shop.products.add-to-cart-variants');
    }
}
