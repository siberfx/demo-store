<?php

namespace App\Http\Livewire;

use GetCandy\Facades\CartSession;
use GetCandy\Facades\ShippingManifest;
use GetCandy\Models\Cart;
use Illuminate\Support\Facades\Session;
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
        $this->cart = CartSession::getCart();
        if (!$this->cart) {
            $this->redirect('/');
        }
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

    public function checkout()
    {
        // Create the order or sutin.
        $order = $this->cart->getManager()->createOrder();

        $order->update([
            'placed_at' => now(),
            'status' => 'paid',
        ]);

        return redirect()->route('checkout-success.view');
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
