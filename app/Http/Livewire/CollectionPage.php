<?php

namespace App\Http\Livewire;

use GetCandy\Models\Collection;
use GetCandy\Models\Url;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;

class CollectionPage extends Component
{
    use PerformsRedirects;

    /**
     * The URL model from the slug.
     *
     * @var \GetCandy\Models\Url
     */
    public ?Url $url = null;

    /**
     * {@inheritDoc}
     *
     * @param string $slug
     * @throws \Http\Client\Exception\HttpException
     * @return void
     */
    public function mount($slug)
    {
        $this->url = Url::whereElementType(Collection::class)
            ->whereDefault(true)
            ->whereSlug($slug)
            ->with([
                'element.products.thumbnail',
                'element.products.variants',
            ])->first();

        if (!$this->url) {
            abort(404);
        }
    }

    /**
     * Computed property to return the collection.
     *
     * @return \GetCandy\Models\Collection
     */
    public function getCollectionProperty()
    {
        return $this->url->element;
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('livewire.collection-page');
    }
}
