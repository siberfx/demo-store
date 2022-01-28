<?php

namespace App\Http\Livewire;

use GetCandy\Facades\CartSession;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;

class CheckoutPage extends Component
{
    use PerformsRedirects;

    /**
     * {@inheritDoc}
     */
    protected $listeners = [
        'addressUpdated' => 'triggerAddressRefresh'
    ];

    /**
     * {@inheritDoc}
     *
     * @return void
     */
    public function mount()
    {
        if (!CartSession::current()) {
            $this->redirect('/');
        }
    }

    /**
     * Trigger an event to refresh addresses.
     *
     * @return void
     */
    public function triggerAddressRefresh()
    {
        $this->emit('refreshAddress');
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
