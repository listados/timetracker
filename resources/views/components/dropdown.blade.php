@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])

<div class="dropdown" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div x-show="open"
         class="dropdown-menu {{ $align === 'left' ? '' : 'dropdown-menu-end' }}"
         style="display: none;"
         @click="open = false">
        <div class="{{ $contentClasses }}">{{ $content }}</div>
    </div>
</div>
