<?php

namespace App\Http\Livewire;

use GetCandy\Facades\CartSession;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;

class CheckoutPage extends Component
{
    use PerformsRedirects;

    protected $listeners = [
        'addressUpdated' => 'triggerAddressRefresh'
    ];

    public function mount()
    {
        if (!CartSession::current()) {
            $this->redirect('/');
        }
    }

    public function triggerAddressRefresh()
    {
        $this->emit('refreshAddress');
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
