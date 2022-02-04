<?php

namespace App\Http\Livewire;

use GetCandy\Models\Collection;
use Livewire\Component;

class Home extends Component
{
    /**
     * Return the sale collection.
     *
     * @return void
     */
    public function getSaleCollectionProperty()
    {
        return Collection::find(6);
    }

    /**
     * Return a random collection.
     *
     * @return void
     */
    public function getRandomCollectionProperty()
    {
        return Collection::inRandomOrder()->first();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
