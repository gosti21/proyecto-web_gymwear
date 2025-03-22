<?php

namespace App\Livewire\Shop\Products;

use App\Traits\Admin\sweetAlerts;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCart extends Component
{
    use sweetAlerts;

    public $product;

    public $qty = 1;

    public function addToCart()
    {
        Cart::instance('shopping');

        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->product->images->first()->path,
                'sku' => $this->product->sku,
                'features' => [],
            ]
        ]);

        if(Auth::check()){
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
        return view('livewire.shop.products.add-to-cart');
    }
}
