<form wire:submit.prevent="save" class="border rounded shadow-lg">
    <div class="p-4 text-xl font-medium border-b">
        {{ ucfirst($type) }} Address
    </div>
    <div class="p-4 space-y-4">
        @if($editing)
            <div class="grid grid-cols-2 gap-4">
                <x-input.group label="First name">
                    <x-input.text wire:model="address.first_name" />
                </x-input.group>

                <x-input.group label="Last name">
                    <x-input.text wire:model="address.last_name" />
                </x-input.group>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="Address line 1" required>
                    <x-input.text wire:model="address.line_one" />
                </x-input.group>

                <x-input.group label="Address line 2">
                    <x-input.text wire:model="address.line_two" />
                </x-input.group>

                <x-input.group label="Address line 3">
                    <x-input.text wire:model="address.line_three" />
                </x-input.group>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <x-input.group label="City" required>
                    <x-input.text wire:model="address.city"/>
                </x-input.group>

                <x-input.group label="State / Province">
                    <x-input.text wire:model="address.state" />
                </x-input.group>

                <x-input.group label="Postcode">
                    <x-input.text wire:model="address.postcode"/>
                </x-input.group>
            </div>

            <div>
                <x-input.group label="Country" required>
                    <select class="w-full p-4 text-sm border-2 border-gray-200 rounded-lg" wire:model="address.country_id">
                        <option value>Select a country</option>
                        @foreach($this->countries as $country)
                            <option value="{{ $country->id }}" wire:key="country_{{ $country->id }}">
                                {{ $country->native }}
                            </option>
                        @endforeach
                    </select>
                </x-input.group>
            </div>
        @endif
    </div>
    <div class="flex justify-end w-full p-4 bg-gray-100">
        <div>
        @if($editing)
            <button type="submit" wire:key="submit_btn" class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                Save Address
            </button>
        @else
            <button type="button" wire:key="edit_btn" wire:click.prevent="$set('editing', true)" class="px-5 py-3 font-medium bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                Edit Address
            </button>
        @endif
        </div>
    </div>
</form>
