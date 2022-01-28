<?php

namespace App\Http\Livewire;

use GetCandy\Facades\CartSession;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;

class CheckoutPage extends Component
{
    use PerformsRedirects;

    public function mount()
    {
        if (!CartSession::current()) {
            $this->redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
