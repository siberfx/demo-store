<?php

namespace App\Http\Livewire;

use GetCandy\Models\Collection;
use GetCandy\Models\Url;
use Livewire\Component;

class CollectionPage extends Component
{
    /**
     * The URL model from the slug.
     *
     * @var \GetCandy\Models\Url
     */
    public ?Url $url = null;

    public function mount($slug)
    {
        $this->url = Url::whereElementType(Collection::class)
            ->whereDefault(true)
            ->whereSlug($slug)
            ->first();

        dd($this->url);
    }

    public function getCollectionProperty()
    {
        dd(1);
        // $this->url
    }

    public function render()
    {
        return view('livewire.collection-page');
    }
}
