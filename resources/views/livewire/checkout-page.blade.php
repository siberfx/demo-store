<div>
  <div class="relative max-w-screen-xl px-4 py-8 mx-auto">
    <div class="flex">
        <div class="space-y-6 grow">
            {{-- @livewire('components.checkout-address', [
                'type' => 'shipping'
            ]) --}}

            @include('partials.checkout.address', [
                'type' => 'shipping',
                'step' => $steps['shipping_address'],
            ])
{{--
            @livewire('components.shipping-options') --}}

            {{-- @livewire('components.checkout-address', [
                'type' => 'billing'
            ]) --}}

            <button wire:click="checkout">Checkout</button>
        </div>
        <div class="w-1/3 ml-12">
            <h3 class="font-bold">Order Summary</h3>

            <div class="mt-6">
                @foreach($cart->lines as $line)
                    <div wire:key="cart_line_{{ $line->id }}" class="flex items-center">
                        <figure>
                            <img src="{{ $line->purchasable->getThumbnail() }}" class="rounded w-14" />
                        </figure>
                        <div class="ml-4">
                            <strong class="block">{{ $line->purchasable->getDescription() }}</strong>
                            {{ $line->quantity }} @ {{ $line->subTotal->formatted() }}
                        </div>
                    </div>
                @endforeach
                <div class="flex justify-between pt-4 mt-4 border-t">
                    <strong class="block">Sub Total</strong>
                    {{ $cart->subTotal->formatted() }}
                </div>
                @if($this->shippingOption)
                    <div class="flex justify-between pt-4 mt-4 border-t">
                        <strong class="block">
                            {{ $this->shippingOption->getDescription() }}
                        </strong>
                        {{ $this->shippingOption->getPrice()->formatted() }}
                    </div>

                @endif
                @foreach($cart->taxBreakdown as $tax)
                    <div class="flex justify-between pt-4 mt-4 border-t">
                        <strong class="block">{{ $tax['rate']->name }}</strong>
                        {{ $tax['total']->formatted() }}
                    </div>
                @endforeach
                <div class="flex justify-between pt-4 mt-4 border-t">
                    <strong class="block">Total</strong>
                    {{ $cart->total->formatted() }}
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
