<div class="border rounded shadow-lg">
    <div class="p-4 text-xl font-medium border-b">
        {{ ucfirst($type) }} Address
    </div>
    <div class="p-4">
        @if($editing)
            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="First name">
                    <x-input.text wire:model="address.first_name" />
                </x-input.group>

                <x-input.group label="Last name">
                    <x-input.text wire:model="address.first_name" />
                </x-input.group>
            </div>

            <div class="grid grid-cols-3">
                <x-input.group label="Address line 1">
                    <x-input.text wire:model="address.first_name" required />
                </x-input.group>
            </div>
        @endif
    </div>
</div>
