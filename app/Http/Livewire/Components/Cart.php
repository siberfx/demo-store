<?php

namespace App\Http\Livewire\Components;

use GetCandy\Facades\CartSession;
use Livewire\Component;

class Cart extends Component
{

    public function mount()
    {
        // dd($this->cart->subTotal);
    }

    public function getCartProperty()
    {
        return CartSession::getCart();
    }

    public function getLinesProperty()
    {
        return $this->cart->lines;
    }

    public function render()
    {
        return view('livewire.components.cart');
    }
}
