<?php

namespace App\Http\Livewire\Components;

use GetCandy\Facades\CartSession;
use GetCandy\Models\Cart;
use GetCandy\Models\CartAddress;
use GetCandy\Models\Country;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CheckoutAddress extends Component
{
    /**
     * The type of address.
     *
     * @var string
     */
    public $type = 'billing';

    /**
     * The ID of the cart.
     *
     * @var string|integer
     */
    public Cart $cart;

    /**
     * Whether we are currently editing the address.
     *
     * @var boolean
     */
    public bool $editing = false;

    /**
     * The checkout address model
     *
     * @var \GetCandy\Models\CartAddress
     */
    public CartAddress $address;

    /**
     * Whether billing is the same as shipping.
     *
     * @var boolean
     */
    public bool $shippingIsBilling = false;

    protected $listeners = [
        'refreshAddress',
    ];

    /**
     * {@inheritDoc}
     */
    public function mount()
    {
        $this->cart = CartSession::current();

        $this->address = $this->cart->addresses->first(fn($add) => $add->type == $this->type) ?: new CartAddress;

        // If we have an existing ID then it should already be valid and ready to go.
        $this->editing = (bool) !$this->address->id;
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'address.first_name' => 'required',
            'address.last_name' => 'required',
            'address.line_one' => 'required',
            'address.country_id' => 'required',
            'address.city' => 'required',
            'address.postcode' => 'required',
            'address.company_name' => 'nullable',
            'address.line_two' => 'nullable',
            'address.line_three' => 'nullable',
            'address.state' => 'nullable',
            'address.delivery_instructions' => 'nullable',
            'address.contact_email' => 'nullable|email',
            'address.contact_phone' => 'nullable',
        ];
    }

    /**
     * Save the cart address.
     *
     * @return void
     */
    public function save()
    {
        $validatedData = $this->validate();

        if ($this->type == 'billing') {
            $this->cart->getManager()->setBillingAddress($this->address);
        }

        if ($this->type == 'shipping') {
            $this->cart->getManager()->setShippingAddress($this->address);
            if ($this->shippingIsBilling) {
                // Do we already have a billing address?
                if ($billing = $this->cart->billingAddress) {
                    $billing->fill($validatedData['address']);
                    $this->cart->getManager()->setBillingAddress($billing);
                } else {
                    $address = $this->address->only(
                        $this->address->getFillable()
                    );
                    $this->cart->getManager()->setBillingAddress($address);
                }
            }
        }

        $this->editing = false;

        $this->emitUp('addressUpdated');
    }

    public function refreshAddress()
    {
        if ($address = $this->cart->addresses()->whereType($this->type)->first()) {
            $this->address = $address;
            $this->editing = false;
        }
    }

    public function getCountriesProperty()
    {
        return Country::whereIn('iso3', ['GBR', 'USA'])->get();
    }

    public function render()
    {
        return view('livewire.components.checkout-address');
    }
}
