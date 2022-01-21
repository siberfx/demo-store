<div class="relative" x-data="{
    linesVisible: true
}">
    <button
        class="inline-flex flex-col items-center justify-center w-16 h-16"
        x-on:click="linesVisible = !linesVisible"
        :class="{
            'bg-gray-900 text-white': linesVisible
        }"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
        />
        </svg>

        <span class="block mt-1 text-xs font-medium">Cart</span>
    </button>
    <div class="absolute right-0 z-50 p-4 bg-gray-900 rounded-b shadow w-96" x-show="linesVisible" x-on:click.away="linesVisible = false">
        <div class="p-4 space-y-2 text-sm bg-white rounded">
            @forelse($lines as $index => $line)
                <div class="flex items-center py-2 space-x-4 border-t first:border-none">
                    <div class="w-1/5">
                        <img src="{{ $line['thumbnail'] }}" class="rounded">
                    </div>
                    <div class="grow">
                        <strong>{{ $line['description'] }}</strong>
                        <span class="block text-xs">{{ $line['identifier'] }}</span>
                        <span class="block text-xs">{{ $line['option'] }}</span>
                        <div class="flex items-center mt-2 space-x-4">
                            <input type="number" class="w-1/3 p-2 text-xs border border-gray-900" wire:model="lines.{{ $index }}.quantity" />
                            <div class="grow">
                                @ {{ $line['sub_total'] }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <span class="text-xs">Go buy something :)</span>
            @endforelse
            <div class="flex items-center justify-between pt-2 border-t">
                <strong>Sub Total</strong>
                {{ $this->cart->subTotal->formatted() }}
            </div>
        </div>
    </div>
</div>
