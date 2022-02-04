<form wire:submit.prevent="checkout" class="border rounded shadow-lg ">
    <div class="flex justify-between p-4 font-medium @if($currentStep < $step) text-gray-500 @endif">
        <span class="text-xl">Payment</span>
    </div>
    @if($currentStep >= $step)
    <div class="p-4">
        <div class="p-4 text-blue-800 rounded bg-blue-50">
            Payment is offline, no card details needed.
        </div>
    </div>
    <div class="flex justify-end w-full p-4 bg-gray-100">
        <div>
            <button type="submit" wire:key="payment_submit_btn" class="px-5 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-500">
                <span wire:loading.remove wire:target="checkout">
                    Make Payment
                </span>
                <span wire:loading wire:target="checkout">
                    <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        </div>
    </div>
    @endif
</form>
