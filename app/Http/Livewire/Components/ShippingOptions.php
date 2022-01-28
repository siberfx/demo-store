<?php

namespace App\Http\Livewire\Components;

use GetCandy\Facades\CartSession;
use GetCandy\Facades\ShippingManifest;
use Livewire\Component;

class ShippingOptions extends Component
{
    /**
     * The chosen shipping option.
     *
     * @var string|null
     */
    public ?string $chosenOption = null;

    /**
     * Return available shipping options.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getShippingOptionsProperty()
    {
        return ShippingManifest::getOptions(
            CartSession::current()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'chosenOption' => 'required',
        ];
    }

    /**
     * Save the shipping option.
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $option = $this->shippingOptions->first(fn($option) => $option->getIdentifier() == $this->chosenOption);

        CartSession::current()->getManager()->setShippingOption($option);

        $this->emit('selectedShippingOption');
    }

    /**
     * Return whether we have a shipping address
     *
     * @return void
     */
    public function getHasShippingAddressProperty()
    {
        return CartSession::current()->shippingAddress()->exists();
    }

    public function render()
    {
        return view('livewire.components.shipping-options');
    }
}
