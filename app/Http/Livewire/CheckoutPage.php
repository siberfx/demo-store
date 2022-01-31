<?php

namespace App\Http\Livewire;

use GetCandy\Facades\CartSession;
use GetCandy\Facades\ShippingManifest;
use GetCandy\Models\Cart;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;

class CheckoutPage extends Component
{
    use PerformsRedirects;

    public ?Cart $cart;

    /**
     * {@inheritDoc}
     */
    protected $listeners = [
        'addressUpdated' => 'triggerAddressRefresh',
        'cartUpdated' => 'refreshCart',
        'selectedShippingOption' => 'refreshCart',
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
        $this->cart = CartSession::getCart();
    }

    public function hydrate()
    {
        $this->cart = CartSession::getCart();
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

    /**
     * Refresh the cart instance.
     *
     * @return void
     */
    public function refreshCart()
    {
        $this->cart = CartSession::getCart();
    }

    public function getShippingOptionProperty()
    {
        $shippingAddress = $this->cart->shippingAddress;

        if ($option = $shippingAddress->shipping_option) {
            return ShippingManifest::getOptions($this->cart)->first(function ($opt) use ($option) {
                return $opt->getIdentifier() == $option;
            });
        }

        return null;
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
