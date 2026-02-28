@props(['name', 'show' => false, 'maxWidth' => '2xl'])

@php
$sizeClass = match($maxWidth) {
    'sm' => 'modal-sm',
    'lg' => 'modal-lg',
    'xl', '2xl' => 'modal-xl',
    default => '',
};
@endphp

<div
    x-data="{ show: @js($show) }"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    class="modal"
    :class="{ 'd-block': show }"
    style="display:none;"
    tabindex="-1"
>
    <div class="modal-dialog {{ $sizeClass }}">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>
<div x-show="show" class="modal-backdrop fade show" style="display:none;" @click="show = false"></div>
