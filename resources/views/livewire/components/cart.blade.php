<div class="relative" x-data="{
    linesVisible: false
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
    <div class="absolute right-0 z-50 w-64 p-4 bg-gray-900 rounded-b shadow" x-show="linesVisible">
        <div class="p-4 space-y-2 text-sm bg-white rounded">
            @forelse($this->lines as $line)
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
