<?php

namespace App\Http\Livewire;

use App\Traits\FetchesUrls;
use GetCandy\Models\Product;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;

class ProductPage extends Component
{
    use FetchesUrls, PerformsRedirects;

    /**
     * The selected option values.
     *
     * @var array
     */
    public $selectedOptionValues = [];

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
                'element.thumbnail',
                'element.variants.basePrices',
                'element.variants.values.option'
            ]
        );

        $this->selectedOptionValues = $this->productOptions->mapWithKeys(function ($data) {
            return [$data['option']->id => $data['values']->first()->id];
        })->toArray();

        if (!$this->variant) {
            abort(404);
        }
    }

    /**
     * Computed property to get variant.
     *
     * @return \GetCandy\Models\ProductVariant
     */
    public function getVariantProperty()
    {
        return $this->product->variants->first(function ($variant) {
            return !$variant->values->pluck('id')
                ->diff(
                    collect($this->selectedOptionValues)->values()
                )->count();
        });
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
