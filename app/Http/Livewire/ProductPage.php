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

    /**
     * Computed property to get variant.
     *
     * @return \GetCandy\Models\ProductVariant
     */
    public function getVariantProperty()
    {
        return $this->product->variants->first();
    }

    /**
     * Computed property to return product.
     *
     * @return \GetCandy\Models\Product
     */
    public function getProductProperty()
    {
        return $this->url->element;
    }

    /**
     * Computed property to return current image.
     *
     * @return string
     */
    public function getImageProperty()
    {
        return $this->product->thumbnail?->getUrl('large');
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('livewire.product-page');
    }
}
