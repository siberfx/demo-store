@props([
    'label' => null,
])

<label class="space-y-2">
    <div class="font-medium font-sm">
        {{ $label }}
    </div>
    {{ $slot }}
</label>
