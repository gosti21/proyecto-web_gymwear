<?php

namespace App\Livewire\Shop\Products;

use App\Models\Feature;
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

    public $selectedFeatures = [];

    public function mount()
    {
        foreach($this->product->options as $option) {
            $features = collect($option->pivot->features);

            $this->selectedFeatures[$option->id] = $features->first()['id'];
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
            Cart::store(auth()->id);
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
