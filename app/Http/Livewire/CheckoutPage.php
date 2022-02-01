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
        return array_merge(
            $this->getAddressValidation('shipping'),
            $this->getAddressValidation('billing'),
            [
                'shippingIsBilling' => true
            ]
        );
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

        // Do we have a shipping address?
        $this->shipping = $this->cart->shippingAddress ?: new CartAddress;
        $this->billing = $this->cart->billingAddress ?: new CartAddress;
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

    public function saveAddress($type)
    {
        $this->validate(
            $this->getAddressValidation($type)
        );

        $address = $this->{$type};


        if ($type == 'billing') {
            $this->cart->getManager()->setBillingAddress($address);
        }

        if ($type == 'shipping') {
            $this->cart->getManager()->setShippingAddress($address);
            // if ($this->shippingIsBilling) {
            //     // Do we already have a billing address?
            //     if ($billing = $this->cart->billingAddress) {
            //         $billing->fill($validatedData['address']);
            //         $this->cart->getManager()->setBillingAddress($billing);
            //     } else {
            //         $address = $this->address->only(
            //             $this->address->getFillable()
            //         );
            //         $this->cart->getManager()->setBillingAddress($address);
            //     }
            // }
        }
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

    /**
     * Return the address validation rules for a given type.
     *
     * @param string $type
     * @return array
     */
    protected function getAddressValidation($type)
    {
        return [
            "{$type}.first_name" => 'required',
            "{$type}.last_name" => 'required',
            "{$type}.line_one" => 'required',
            "{$type}.country_id" => 'required',
            "{$type}.city" => 'required',
            "{$type}.postcode" => 'required',
            "{$type}.company_name" => 'nullable',
            "{$type}.line_two" => 'nullable',
            "{$type}.line_three" => 'nullable',
            "{$type}.state" => 'nullable',
            "{$type}.delivery_instructions" => 'nullable',
            "{$type}.contact_email" => 'nullable|email',
            "{$type}.contact_phone" => 'nullable',
        ];
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
