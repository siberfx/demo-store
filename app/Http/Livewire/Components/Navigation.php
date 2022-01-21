<?php

namespace App\Http\Livewire\Components;

use GetCandy\Models\Collection;
use Livewire\Component;

class Navigation extends Component
{
    public function getCollectionsProperty()
    {
        return Collection::with(['defaultUrl'])->get()->toTree();
    }

    public function render()
    {
        return view('livewire.components.navigation');
    }
}
