@props(['value'])

<label {{ $attributes->merge(['class' => 'formLabel']) }}>
    {{ $value ?? $slot }}
</label>
