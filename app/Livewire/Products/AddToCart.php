<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Component
{

    public $product;
    public $variant;
    public $qty = 1;

    public $selectedFeatures = [];

    public function mount()
    {
        /*foreach ($this->product->options as $option) {

            $features = collect($option->pivot->features);

            $this->selectedFeatures[$option->id] = $features->first()['id'];
        }*/
  $firstVariant = $this->product->variants->first();

    if ($firstVariant) {
        $this->selectedFeatures = $firstVariant->features->pluck('id', 'option_id')->toArray();
        $this->getVariant();
    }
    }

    /*public function updated($name, $value)
    {
        if ($name == 'selectedFeatures') {

        }

    }*/

    public function updatedSelectedFeatures()
    {
        $this->getVariant();
    }
    public function getVariant()
    {
        $this->variant = $this->product->variants->filter(function ($variant) {
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);
        })->first();
    }

    public function add_to_cart()
    {
        Cart::instance('shopping');
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->product->image,
                'sku' => $this->variant,
                'features' => Feature::whereIn('id', $this->selectedFeatures)
                    ->pluck('description', 'id')
                    ->toArray()
            ],
            'tax' => 18,
        ])
            ->associate(Product::class);

        if (Auth::check()) {
            Cart::store(Auth::id());
        }

        $this->dispatch('cartUpdated', Cart::count());



        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho',
            'text' => 'Producto añadido al carrito',
        ]);
    }



    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
