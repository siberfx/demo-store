<div>
  <div class="relative max-w-screen-xl px-4 py-8 mx-auto">
    <div class="flex">
        <div class="space-y-6 grow">
            @livewire('components.checkout-address', [
                'type' => 'shipping'
            ])

            @livewire('components.checkout-address', [
                'type' => 'billing'
            ])
        </div>
        <div class="w-1/3">
        </div>
    </div>
  </div>
</div>
