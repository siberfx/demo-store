<?php

namespace App\Http\Livewire;

use GetCandy\Facades\CartSession;
use GetCandy\Facades\ShippingManifest;
use GetCandy\Models\Cart;
use GetCandy\Models\CartAddress;
use GetCandy\Models\Country;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;

class CheckoutPage extends Component
{
    use PerformsRedirects;

    /**
     * The Cart instance.
     *
     * @var Cart|null
     */
    public ?Cart $cart;

    /**
     * The shipping address instance.
     *
     * @var CartAddress|null
     */
    public ?CartAddress $shipping = null;

    /**
     * The billing address instance.
     *
     * @var CartAddress|null
     */
    public ?CartAddress $billing = null;

    /**
     * {@inheritDoc}
     */
    protected $listeners = [
        'cartUpdated' => 'refreshCart',
        'selectedShippingOption' => 'refreshCart',
    ];

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'shipping.first_name' => 'required',
            'shipping.last_name' => 'required',
            'shipping.line_one' => 'required',
            'shipping.country_id' => 'required',
            'shipping.city' => 'required',
            'shipping.postcode' => 'required',
            'shipping.company_name' => 'nullable',
            'shipping.line_two' => 'nullable',
            'shipping.line_three' => 'nullable',
            'shipping.state' => 'nullable',
            'shipping.delivery_instructions' => 'nullable',
            'shipping.contact_email' => 'nullable|email',
            'shipping.contact_phone' => 'nullable',
            'billing.first_name' => 'required',
            'billing.last_name' => 'required',
            'billing.line_one' => 'required',
            'billing.country_id' => 'required',
            'billing.city' => 'required',
            'billing.postcode' => 'required',
            'billing.company_name' => 'nullable',
            'billing.line_two' => 'nullable',
            'billing.line_three' => 'nullable',
            'billing.state' => 'nullable',
            'billing.delivery_instructions' => 'nullable',
            'billing.contact_email' => 'nullable|email',
            'billing.contact_phone' => 'nullable',
        ];
    }

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

        if (!$shippingAddress) {
            return;
        }

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

    /**
     * Return the available countries.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCountriesProperty()
    {
        return Country::whereIn('iso3', ['GBR', 'USA'])->get();
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
