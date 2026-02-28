@props(['active'])

@php
$classes = ($active ?? false) ? 'nav-link active px-3' : 'nav-link px-3';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
