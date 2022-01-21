<?php

namespace App\Http\Livewire\Components;

use GetCandy\Facades\CartSession;
use Livewire\Component;

class Cart extends Component
{
    public array $lines;

    public function mount()
    {
        $this->mapLines();
    }

    public function getCartProperty()
    {
        return CartSession::current();
    }

    public function getCartLinesProperty()
    {
        return $this->cart->lines;
    }

    /**
     * Map the cart lines.
     *
     * We want to map out our cart lines like this so we can
     * add some validation rules and make them editable.
     *
     * @return void
     */
    public function mapLines()
    {
        $this->lines = $this->cartLines->map(function ($line) {
            return [
                'id' => $line->id,
                'identifier' => $line->purchasable->getIdentifier(),
                'quantity' => $line->quantity,
                'description' => $line->purchasable->getDescription(),
                'thumbnail' => $line->purchasable->getThumbnail(),
                'option' => $line->purchasable->getOption(),
                'sub_total' => $line->subTotal->formatted(),
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.components.cart');
    }
}
