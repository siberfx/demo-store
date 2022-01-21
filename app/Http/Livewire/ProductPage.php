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
                'element.variants.basePrices',
                'element.variants.values.option'
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
     * Computed property to return all available option values.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProductOptionValuesProperty()
    {
        return $this->product->variants->pluck('values')->flatten();
    }

    /**
     * Computed propert to get available product options with values.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getProductOptionsProperty()
    {
        return $this->productOptionValues->groupBy('product_option_id')
            ->map(function ($values) {
                return [
                    'option' => $values->first()->option,
                    'values' => $values,
                ];
            })->values();
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
