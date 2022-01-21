<?php

namespace App\View\Components;

use GetCandy\Models\Price;
use GetCandy\Models\Product;
use Illuminate\View\Component;

class ProductPrice extends Component
{
    public ?Price $price = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->price = $product->variants
            ->pluck('basePrices')
            ->flatten()
            ->sortBy('price')
            ->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-price');
    }
}
