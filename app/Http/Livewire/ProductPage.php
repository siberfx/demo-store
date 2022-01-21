<?php

namespace App\Http\Livewire;

use App\Traits\FetchesUrls;
use GetCandy\Models\Product;
use Livewire\Component;

class ProductPage extends Component
{
    use FetchesUrls;

    /**
     * {@inheritDoc}
     *
     * @param string $slug
     * @return void
     */
    public function mount($slug)
    {
        $this->url = $this->fetchUrl(
            $slug,
            Product::class,
            [
                'element.media',
                'element.variants.basePrices'
            ]
        );
    }

    public function getProductProperty()
    {
        return $this->url->element;
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('livewire.product-page');
    }
}
